#!/usr/bin/python
# coding: utf-8
import os, sys

import json

import smtplib
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText

with open(os.path.abspath(os.path.dirname(sys.argv[0])) + '/receiveSMS.conf') as f:
	config = json.load(f)
print(json.dumps(config, indent = 2, sort_keys=True))
print(config)
print "config['mailserver']['host']="+config['mailserver']['host']
print "config['mailserver']['port']="+config['mailserver']['port']

numparts = int(os.environ['DECODED_PARTS'])

text = ''
# Are there any decoded parts?
if numparts == 0:
    text = os.environ['SMS_1_TEXT']
# Get all text parts
else:
    for i in range(1, numparts + 1):
        varname = 'DECODED_%d_TEXT' % i
        if varname in os.environ:
            text = text + os.environ[varname]

# Do something with the text
print('Number %s have sent text: %s' % (os.environ['SMS_1_NUMBER'], text))

msg = MIMEMultipart()
msg['From'] = config['from']
msg['To'] = config['to']
msg['Subject'] = config['subject'] + os.environ['SMS_1_NUMBER'] 
message = text
msg.attach(MIMEText(message))
mailserver = smtplib.SMTP(config['mailserver']['host'], int(config['mailserver']['port']))
mailserver.ehlo()
mailserver.sendmail(msg['From'], msg['To'], msg.as_string())
mailserver.quit()
