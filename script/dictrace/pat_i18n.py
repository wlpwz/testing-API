#************************************************************************
# * 
# * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
# * 
# **************************************************************************/
 
 
 
#/**
# * @file pat.py
# * @author huangwei16(com@baidu.com)
# * @date 2016/04/20 19:40:36
# * @brief 
# *  
# **/
import os
import sys
import Queue
import threading
import socket
result = Queue.Queue()
server_list = []
def printer():
    global server_list
    count = 0
    global result
    while True:
        res = result.get()
        print res
        count = count + 1
        if count >= len(server_list):
            break

def single_processor(server, task_id, cmd, timeout):
    global result
    try:
        sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        sock.connect((server, 9509))
        sock.settimeout(5)
        msg = sock.recv(1024)
        sock.settimeout(timeout+10)
        sock.sendall("pat#" + task_id + "#" + cmd + "#" + str(timeout))
        sock.shutdown(1)
        msg = ""
        while True:
            buf = sock.recv(1024)
            if not buf:
                break
            msg = msg + buf
        result.put(server + " response OK!\n" + msg)
        sock.close()
    except:
         result.put(server + " response FAILD!\n")
        

if __name__ == '__main__':
    task_id = sys.argv[1]
    cmd = sys.argv[2]
    timeout = int(sys.argv[3])
    file = open("server_list_i18n", "r")
    try:
        for line in file:
            server_list.append(line.strip('\n'))
    except:
        print "The server list does not exist!\n"
        file.close()
        exit(1)
    file.close()
    printer_thread = threading.Thread(target=printer)
    printer_thread.setDaemon(True)
    printer_thread.start()
    thread_pool = []
    for server in server_list:
        process_thread = threading.Thread(target=single_processor, args=(server, task_id, cmd,
            timeout))
        process_thread.setDaemon(True)
        process_thread.start()
        thread_pool.append(process_thread)
    for process_thread in thread_pool:
        process_thread.join()
    printer_thread.join()
    exit(0)




















#/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */
