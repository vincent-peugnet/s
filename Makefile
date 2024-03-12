src_dirs   = $(shell find src -type d -not -name src)
scene_dirs = $(shell ls -d src/*)
build_dirs = build $(src_dirs:src/%=build/%)
kra_files  = $(shell find src -type f -name '*.kra')
png_files  = $(kra_files:src/%.kra=build/%.png)
jpg_files  = $(png_files:.png=.jpg)
webp_files = $(png_files:.png=.webp)
avif_files = $(png_files:.png=.avif)
src_info_files  = $(shell find src -type f -name 'info.txt')
build_info_files = $(src_info_files:src/%=build/%)
src_data_files  = $(shell find src -type f -name 'data.yml')
build_data_files = $(src_data_files:src/%=build/%)
cp_build_files = $(build_info_files) $(build_data_files)
html_files = $(scene_dirs:src/%=build/%/index.html)
pdf_files  = $(html_files:.html=.pdf)
# used for secondary expansion
% := %

.SECONDEXPANSION:
.INTERMEDIATE: $(png_files)
.NOTINTERMEDIATE: $(jpg_files) $(webp_files) $(avif_files) $(html_files)

.PHONY: all
all: build/index.pdf html;

.PHONY: html
html: build/index.html build/base.css $(html_files);

.PHONY: watch
watch: html
	@echo Watching files for changes
	fswatch --event 30 -r src templates base.css 2> /dev/null | xargs -I{} $(MAKE) html --no-print-directory

build/base.css: base.css | build
	cp $< $@

build/index.html: src templates/index.php | build
	php templates/index.php src > $@

build/index.pdf: $(pdf_files)
	pdfunite $^ $@

%/index.html: $$(filter %$%,$(jpg_files) $(cp_build_files)) templates/scene.php | %
	php templates/scene.php src $(@D) > $@

%/index.pdf: %/index.html build/base.css
	weasyprint $< $@

$(cp_build_files): build/%: src/% | $$(@D)
	cp $< $@

%.jpg %.webp %.avif: %.png
	convert -resize 50% -quality 50 $< $@

$(png_files): build/%.png: src/%.kra | $$(@D)
	unzip -p $< mergedimage.png > $@

$(build_dirs):
	mkdir -p $@

.PHONY: clean
clean:
	rm -rf build
