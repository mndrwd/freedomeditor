#!/bin/sh
# BASH SCRIPT TO SETUP MAINTAINANCE FOR PORTS TREE FREEBSD 6.1
# SETTINGS:
#set a default host
host="cvsup3.nl.freebsd.org"
#install cvsup with graphical user interface
cvsupgui="YES"

# OPERATION:
# set the refuse options below
# then run this script as root
# after that you can run /usr/go to update your ports database
# Now you can check if your actual ports need updating:
#	portversion -v 
# now you have to view the /usr/ports/UPDATING
# for information about any possible current updating issues
# to upgrade the flagged-for-updating ports (can be Dangerous!)
# portupgrade -ra
# then to fix possible dependency issues:
# pkgdb -F

mkdir -p /usr/sup
cd /usr/sup

#You want to comment out the things you use or add some to refuse:
echo 'ports/cad'		>> refuse
echo 'ports/chinese'		>> refuse
echo 'ports/french'		>> refuse
echo 'ports/german'		>> refuse
echo 'ports/hebrew'		>> refuse
echo 'ports/hungarian'		>> refuse
echo 'ports/japanese'		>> refuse
echo 'ports/korean'		>> refuse
echo 'ports/palm'		>> refuse
echo 'ports/portuguese'		>> refuse
echo 'ports/russian'		>> refuse
echo 'ports/ukrainian'		>> refuse
echo 'ports/vietnamese'		>> refuse
echo 'doc/de_DE.ISO8859-1'	>> refuse
echo 'doc/el_GR.ISO8859-7'	>> refuse
echo 'doc/es_ES.ISO8859-1'	>> refuse
echo 'doc/fr_FR.ISO8859-1'	>> refuse
echo 'doc/it_IT.ISO8859-15'	>> refuse
echo 'doc/ja_JP.eucJP'		>> refuse
echo 'doc/nl_NL.ISO8859-1'	>> refuse
echo 'doc/pt_BR.ISO8859-1'	>> refuse
echo 'doc/ru_RU.KOI8-R'		>> refuse
echo 'doc/sr_YU.ISO8859-2'	>> refuse
echo 'doc/zh_TW.Big5'		>> refuse



echo '#!/bin/sh'			>> go
echo 'cd /usr/sup'			>> go
echo 'cvsup ports'			>> go
echo 'cd /usr/ports'			>> go
echo 'make fetchindex'			>> go
echo 'pkg_version -v | grep needs'	>> go
chmod 700 go
echo '*default tag=.'					>> ports
echo '*default host='"$host"				>> ports
echo '*default prefix=/usr'				>> ports
echo '*default base=/usr'				>> ports
echo '*default release=cvs delete use-rel-suffix compress' >> ports
echo 'ports-all release=cvs'		>> ports

if [ $cvsupgui = "YES" ]
then
pkg_add -r cvsup
else
pkg_add -r cvsup-without-gui
fi
pkg_add -r portupgrade
rehash
