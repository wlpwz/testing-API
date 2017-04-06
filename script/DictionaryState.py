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



def hi_alert(str):
#message = str
    base_url = "http://jingle.baidu.com/alert/push"
    post_data = {
        "appId":"658",
        "token":"570e4ec2833bd8bc0b3c9869",
        "alertList":[
			{"channel": "hi-group",
			 "description": str,
             "receiver": "1553454"
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
message = str(sys.argv[1])
#arr = str(sys.argv).encode('gbk')
#message = ' '.join(arr[1:])
hi_alert(message)
#urllib2.quote(message)
#print arr
