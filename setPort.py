#!/usr/bin/python
# coding=utf8 rajan @_@
import sys;
import os;
if __name__ == "__main__":
    type = sys.argv[1];
    port = sys.argv[2];
    if not type or not port:
        print("type or port can not be null");
        sys.exit(0)
    cmd = "/sbin/iptables -I INPUT -p %s --dport %s -j ACCEPT"%(type,port)
    print(cmd);
    # commands.getstatusoutput()

