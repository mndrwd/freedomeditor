#!/bin/sh
# ADD A FLUXBOX DESKTOP WITH A BASH SCRIPT FREEBSD 6.2

#	after a minimum install of freebsd, you have to type as root:
# pkg_add -r eterm 
# pkg_add -r sudo
#	then try
# man sudoers
#	set it up so that your user is part of the wheel group


cmd_prefix="Eterm -e "			
		# perform in terminal (close terminal when done)
# cmd_prefix="Eterm --pause -e "		
		# perform in terminal (dont close terminal when done)

# don't forget to edit /etc/ttys
# change "xdm -nodaemon" to "slim"
# to enable launching graphical login at boottime

cd

echo '#screenblanking off' >> .xinitrc
echo 'xset s off'  >> .xinitrc
echo '#nrg star on' >> .xinitrc
echo 'xset dpms 600 60 60'  >> .xinitrc
echo '#load optional fonts' >> .xinitrc
echo "xset +fp $X_FONTPATH" >> .xinitrc
echo 'xset fp rehash' >> .xinitrc
echo '#fluxbox' >> .xinitrc
echo "fluxbox & wmpid=$!" >> .xinitrc
echo '# run dockapps here' >> .xinitrc
echo 'Esetroot -s ~/img/desktop_background.jpg' >> .xinitrc
echo 'rox -pinboard=Default' >> .xinitrc
echo 'wmxmms -t -n & ' >> .xinitrc
echo '# HANG POINT - wait for window manager to exit' >> .xinitrc
echo 'wait $wmpid' >> .xinitrc
echo '# restore the x fontpath' >> .xinitrc
echo 'xset fp default' >> .xinitrc





$cmd_prefix sudo pkg_add -r slim
#graphical login manager

$cmd_prefix sudo pkg_add -r fluxbox
#very fast graphical user interface

$cmd_prefix sudo pkg_add -r rox
#great filesys browser, cool plugins on its site
$cmd_prefix sudo pkg_add -r xmms
#winamp replacer (can use winamp skins)
#enable sound at boot:
$cmd_prefix sudo echo 'sound_load="YES"			# Digital sound subsystem'	>> /boot/loader.conf
$cmd_prefix sudo echo 'snd_driver_load="YES"		# All sound drivers'			>> /boot/loader.conf

$cmd_prefix sudo pkg_add -r xemacs
$cmd_prefix echo "(global-set-key [mouse-4] 'scroll-down)" >> ~/.xemacs/custom.el
$cmd_prefix echo "(global-set-key [mouse-5] 'scroll-up)" >> ~/.xemacs/custom.el
# great text editor 
$cmd_prefix sudo pkg_add -r gftp
#nice ftp client
$cmd_prefix sudo pkg_add -r zircon
#irc client
$cmd_prefix sudo pkg_add -r qtfw
#graphical interface for ipfw(firewall)
$cmd_prefix sudo pkg_add -r gimp
#graphic editor client
$cmd_prefix sudo pkg_add -r nmap
#portscanner client
$cmd_prefix sudo pkg_add -r thunderbird
#mail client
$cmd_prefix sudo pkg_add -r firefox
#webbrowser
$cmd_prefix sudo pkg_add -r gqview 
# image viewer
$cmd_prefix sudo pkg_add -r amsn
#msn client:)

$cmd_prefix sudo pkg_add -r vlc
#note you could instead download a plugin for xmms to view video files

$cmd_prefix sudo pkg_add -r xpdf
#pdf viewer
