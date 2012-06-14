RMDFILE := $(wildcard *.Rmd)

MDFILE := $(RMDFILE:.Rmd=.md)

MARKDOWNFILE := $(RMDFILE:.Rmd=.markdown)

all : $(MARKDOWNFILE)

$(MARKDOWNFILE) : $(MDFILE)
	php md2markdown.php $(@:.markdown=.md)

$(MDFILE) : $(RMDFILE)
	R --slave --vanilla --args $(@:.md=.Rmd) < Rmd2md.R



