#!/bin/bash

source ~/.bashrc

outputpath=$1
bak_dc_path="/home/spider/platform_dc/test/LineOndc/outcome/LineOndc"

cp -r $bak_dc_path/* $outputpath

exit 0
