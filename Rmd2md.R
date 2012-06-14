args <- commandArgs(trailingOnly = TRUE)
require(knitr) # required for knitting from rmd to md
require(markdown) # required for md to html 
src <- args
dst <- sub(".Rmd", ".md", src)
knit(args, dst)
