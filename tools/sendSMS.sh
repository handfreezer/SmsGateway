#!/bin/bash

if [ ${#} -ne 2 ]
then
	echo "nb param incorrect [nb=${#}]"
	exit 1
fi

. $(dirname ${0})/$(basename ${0} .sh).conf

/usr/bin/curl -kvL -H "Content-Type: application/json" -d "{\"token\":\"${SMSCTRL_TOKEN}\", \"gsm\":\"${1}\", \"msg\":\"${2}\"}" "${SMSCTRL_URL}"

