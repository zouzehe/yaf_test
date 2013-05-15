#!/bin/sh
path="/tmp/"
basePath="/work/web/tj/web/stats.candou.com/shell/daemon/"
files=("CreatTableDaemon" "AnalysisDaemon" "RedisDownDaemon" "LimitedCountDaemon")

for file in ${files[*]} ; do
filepid=$path$file.pid
filephp=$basePath$file.php
if [ -f $filepid ]
then
      pid=`cat $filepid`
#      line=`ps -ef | grep $pid| wc -l`
      ps -p $pid >> /dev/null
                    #if [ "$line" -ne "2" ]
      if [ $? -ne 0 ]
      then
          `rm -f $filepid > /dev/null`
           echo `date`   $filephp  restart >> /tmp/restart.log
           php $filephp start >> /dev/null
      fi
else
       echo `date`   $filephp  restart >> /tmp/restart.log
       php $filephp start >> /dev/null
fi

done
