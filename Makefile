kra_files = $(shell find -type f -name '*.kra')
png_files = $(kra_files:.kra=.png)

.PHONY: all
all: $(png_files);

$(png_files): %.png: %.kra
	python3 KritaPy.py $< $@

.PHONY: clean
clean:
	rm -f $(png_files)
