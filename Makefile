src_dirs   = $(shell find src -type d)
scene_dirs = $(shell ls -d src/*)
build_dirs = $(src_dirs:src/%=build/%)
kra_files  = $(shell find src -type f -name '*.kra')
txt_files  = $(shell find src -type f -name 'info.txt')
png_files  = $(kra_files:src/%.kra=build/%.png)
info_files = $(txt_files:src/%=build/%)
webp_files = $(png_files:.png=.webp)
avif_files = $(png_files:.png=.avif)
html_files = $(scene_dirs:src/%=build/%/index.html)
pdf_files  = $(html_files:.html=.pdf)
# used for secondary expansion
% := %

.SECONDEXPANSION:
.INTERMEDIATE: $(png_files)
.NOTINTERMEDIATE: $(webp_files) $(avif_files) $(info_files) $(html_files)

.PHONY: all
all: build/index.pdf build/index.html build/base.css;

.PHONY: watch
watch: all
	@echo Watching files for changes
	fswatch --event 30 -r src templates base.css 2> /dev/null | xargs -I{} $(MAKE) --no-print-directory

build/base.css: base.css
	cp $< $@

build/index.html: $(build_dirs) templates/index.php
	php templates/index.php $(@D) > $@

build/index.pdf: $(pdf_files)
	pdfunite $^ $@

%/index.html: $$(filter %$%,$(webp_files) $(info_files)) templates/scene.php | %
	php templates/scene.php $(@D) > $@

%/index.pdf: %/index.html build/base.css
	weasyprint $< $@

build/%/info.txt: src/%/info.txt
	cp $< $@

%.webp %.avif: %.png
	convert $< $@

$(png_files): build/%.png: src/%.kra | $$(@D)
	unzip -p $< mergedimage.png > $@

$(build_dirs):
	mkdir -p $@

.PHONY: clean
clean:
	rm -rf build
