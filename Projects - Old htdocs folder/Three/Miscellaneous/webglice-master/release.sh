#!/bin/sh
python build.py release
cp build/main.js build/main_concat.js
uglifyjs build/main_concat.js > build/main.js
rm build/main_concat.js
rsync -vrt --copy-links build/* 29a.ch:/var/www/29a.ch/sandbox/2011/webglice/
python build.py
