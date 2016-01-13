#!/bin/sh

# ANY ARCHIVE TYPE EXTRACTING AND/OR UNPACKING SCRIPT
#version 1.0
#by Bart Bosma
#bart +_at_+ bartbosma.eu

#Oudehorne

#Copyright (c) 2008, B.G. Bosma
#All rights reserved.

#Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

#    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
#    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
#    * Neither the name of bosma-autos.nl nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
#
#THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.



# thanks to:
# http://www-128.ibm.com/developerworks/library/l-lw-comp.html
# and creators of lots of open source software making this all possible.
l


# CURRENTLY SUPPORTS:
# zip, tar(.*), gz, tgz, arc, sit, arj, lzh, lha, rar, zoo, tbz, bz2
# ----------------------------

# HOWEVER note that unrar-3.60,4 still doesnt supports the new rar algorithm yet
# possibly doesnt  work with regular .bz2 files
# Syntax:
# aateau.sh path/file

#	When using rox-filer
# 	move this file to /bin
# 	set startaction :
#  	roxunzip.sh "$@" -rox


#----------------------------
# SETTINGS

# required:
	#HOMEDIR PATH PREFIX:
packed="dl"
# 	this is where your archives are supposed to be when not using the optional -rox cmdline argument.
# 	represents /home/user/dl, also ~/dl
# 	if empty, you need to submit complete relative path on cmd line or use -rox.
#	Otherwise, /home/user (or ~/) becomes base path,
#	then it will search for the archive in there

# optional:
# 	baseTargetfolder:
# 	main folder in your users homedir where every archive gets extracted in a subfolder
# 	if it doesnt exists it gets created 
unpackto="."	
#	represents /home/user - note: this probably wont be created when missing		
unpackto="unpax"
# 	represents /home/user/unpax, also ~/unpax


#Archives Target foldername
# *1	use filename 
# *2	use timestamp
sfolderz="1" 
stampformat="+%Y-%m-%d__%H-%M-%S"


cmd_prefix="xterm -e "			
		#perform in terminal (close terminal when done)
#cmd_prefix="xterm -hold -e "		
		#perform in terminal (dont close terminal when done)
#cmd_prefix=""				
		#perform silent


# END SETTINGS
#-----------------------------

# run this script from commandline like this
# ./aateau.sh install_ziprox
# to be able to send files and folders in rox-filer into .zip archives

if [ $1 = "install_ziprox" ]
then
cd
mkdir "$packed"
echo '#!/bin/sh'                 > .config/rox.sourceforge.net/Sendto/zip.sh
echo 'zip -r "$packed/`basename "$1"`" "$1"' >> .config/rox.sourceforge.net/SendTo/zip.sh
chmod 700 ".config/rox.sourceforge.net/SendTo/zip.sh"
exit
fi


#run this script like :aateau.sh install_roxmime
#to (re)link zip, bzip, tar and rar files with rox-filer

if [ $1 = "install_roxmime" ]
then
cd
echo '#!/bin/sh'                 > .config/rox.sourceforge.net/MIME-types/application_x-bzip-compressed-tar
echo 'exec /bin/aateau.sh "$@" -rox' >> .config/rox.sourceforge.net/MIME-types/application_x-bzip-compressed-tar
chmod 700 ".config/rox.sourceforge.net/MIME-types/application_x-bzip-compressed-tar"

echo '#!/bin/sh'                 > .config/rox.sourceforge.net/MIME-types/application_x-compressed-tar
echo 'exec /bin/aateau.sh "$@" -rox' >> .config/rox.sourceforge.net/MIME-types/application_x-compressed-tar
chmod 700 ".config/rox.sourceforge.net/MIME-types/application_x-compressed-tar"

echo '#!/bin/sh'                 > .config/rox.sourceforge.net/MIME-types/application_x-rar
echo 'exec /bin/aateau.sh "$@" -rox' >> .config/rox.sourceforge.net/MIME-types/application_x-rar
chmod 700 ".config/rox.sourceforge.net/MIME-types/application_x-rar"

echo '#!/bin/sh'                 > .config/rox.sourceforge.net/MIME-types/application_x-tar
echo 'exec /bin/aateau.sh "$@" -rox' >> .config/rox.sourceforge.net/MIME-types/application_x-tar
chmod 700 ".config/rox.sourceforge.net/MIME-types/application_x-tar"

echo '#!/bin/sh'                 > .config/rox.sourceforge.net/MIME-types/application_zip
echo 'exec /bin/aateau.sh "$@" -rox' >> .config/rox.sourceforge.net/MIME-types/application_zip
chmod 700 ".config/rox.sourceforge.net/MIME-types/application_zip"

exit
fi


cd
cd "$packed"
if [ $2 = "-rox" ]
then
rox="$1"
else
rox="`pwd`/`basename "$1"`"
fi
filenam=`basename "$1"`
if [ $rox = "" ]
then
exit
fi
if [ $rox = `pwd` ]
then
exit
fi
		#$cmd_prefix echo "$rox"
		#exit

if [ $sfolderz = "1" ]
then
test="$filenam"
else
test=`date "$stampformat"`
fi
		#$cmd_prefix echo "$test"
		#exit

infos=$(file "$rox")
		#$cmd_prefix echo "$infos"
		#exit

#get everything before the :
infoy=${infos%:*}
		#$cmd_prefix echo "$infoy"
		#exit
#get everything before the next :
infos=${infoy%:*}

# get extension; everything after last '.'
# thanks to http://www.splike.com/howtos/bash_faq.html
infozz=${infos##*.}
	
#get evryhthing before teh space lol
formatt=${infozz% *}
		#$cmd_prefix echo "$formatt"
		#exit

#2nov 2008 reliability bugfix: get everything before some "
formaty=${formatt%\"*}

#make the BIG characters small
formatz=$(echo $formaty| tr '[A-Z]' '[a-z]');
		#$cmd_prefix echo "$formatz"
		#exit
#goto invoking user its homefolder
	cd
#make target folder based on filename or timestamp
	mkdir -p "$unpackto/$test"
	cd "$unpackto/$test"
	case $formatz in
	zip)
	$cmd_prefix unzip "$rox"
	;;
	tar)
	$cmd_prefix tar -xvzf "$rox"
	;;
	gz)
	$cmd_prefix tar -zxf "$rox"
	;;
	tgz)
	$cmd_prefix tar -xvzf "$rox"
	;;
	arc)
	$cmd_prefix unstuff "$rox"
	;;
	sit)
	$cmd_prefix unstuff "$rox"
	;;
	arj)
	$cmd_prefix unarj x "$rox"
	;;
	lzh)
	$cmd_prefix lha e "$rox"
	;;
	lha)
	$cmd_prefix lha e "$rox"
	;;
	rar)
	$cmd_prefix unrar x "$rox"
	;;
	zoo)
	$cmd_prefix zoo e "$rox"
	;;
	bz2)
	$cmd_prefix tar -xjvf "$rox"
    ;;
	

*)
echo ""
echo "Usage: `basename $0` filename"
echo "or use rox-filer its shell command: `basename $0`" '"$@"'" -rox"
echo "or use -install_ziprox to install option to create new archive from a folder in rox-filer"
echo "or use -install_roxmime to (re)link .zip .bzip .rar .tar in rox-filer"
exit
;;
esac

