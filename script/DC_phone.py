#!/usr/bin/env python
# -*- coding: utf-8 -*-
########################################################################
# 
# Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
# 
########################################################################
 
"""
File: phone.py
Author: work(work@baidu.com)
Date: 2016/04/13 23:41:59
"""
import json
#import requests
import urllib
import urllib2
import time
import sys
#id为658
#token为570e4ec2833bd8bc0b3c9869



def phone_alert(str):
#message = str
    base_url = "http://jingle.baidu.com/alert/push"
    post_data = {
        "appId":"658",
        "token":"570e4ec2833bd8bc0b3c9869",
        "alertList":[
			{"channel": "sms",
			 "description": str,
			 "level": "major",
             "receiver": "18810698681;liuwenli;18612028968"
			}
        ]
    }
     
    #r= requests.post(base_url, data=json.dumps(post_data))
    try:
        r =  urllib2.urlopen(base_url, data=json.dumps(post_data))
        ret = json.loads(r.read())
        print ret
        if ret["code"] == '1000':
            return True
        else:
            return False
    except Exception as e:
        print e
        return False
#get_zhiban_list()
arr = str(sys.argv)
message = ' '.join(arr)
message = "下列DC任务重启次数已超过两次，请进行检查:"+message
phone_alert(message)
#print is_phone_alert('caoxuehui', '新浪财经美股实时英文代码', 24*60*60)

