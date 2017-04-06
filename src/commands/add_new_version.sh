#!/bin/bash

ENV_PATH=/home/work/LibPP/ENV_ITLG
BVC_CLIENT=db-bvc-client0.db01
ITLG_EC1_PATH_SANDBOX=ftp://db-bvc-client0.db01/home/spider/i18n-ec1-x-sandbox-itlg
ITLG_EC2_PATH_SANDBOX=ftp://db-bvc-client0.db01/home/spider/i18n-ec2-x-sandbox-itlg
ITLG_EC1_PATH_ONLINE=ftp://db-bvc-client0.db01/home/spider/i18n-ec1-x-itlg
ITLG_EC2_PATH_ONLINE=ftp://db-bvc-client0.db01/home/spider/i18n-ec2-x-itlg

if [ x$1 = x ]
then
	exit 1;
fi

version=`echo $1 | sed "s/-/\./g"`

mkdir -p $ENV_PATH/$version

cd $ENV_PATH/$version

wget -r -nH --preserve-permissions --level=0 --cut-dirs=2 ftp://db-bvc-client0.db01/home/spider/i18n-ec1-x-itlg

wget -r -nH --preserve-permissions --level=0 --cut-dirs=2 ftp://db-bvc-client0.db01/home/spider/i18n-ec2-x-itlg

wget -r -nH --preserve-permissions --level=0 --cut-dirs=2 ftp://db-bvc-client0.db01/home/spider/i18n-ec1-x-sandbox-itlg

wget -r -nH --preserve-permissions --level=0 --cut-dirs=2 ftp://db-bvc-client0.db01/home/spider/i18n-ec2-x-sandbox-itlg
