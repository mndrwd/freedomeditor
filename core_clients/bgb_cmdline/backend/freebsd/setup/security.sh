#!/bin/sh
# SETUP FREEBSD 6.1 SECURITY AND INTERNET CONNECTION SHARING WITH BASH SCRIPT
lc="nl"
#	language for time clock
#	http://www.pool.ntp.org/zone

#install internet connection sharing to kernel and setup natd
#ics="yes"
#createnewkernel="yes"
#your extern networking interface (attached to your internet connection):
#eif="rl0"
#eif="xl0"

#if no cmdline input passed to this file at runtime, ["./sec.sh bla"] protect rc.conf
if test $# -eq 0
then
chmod 100 /etc/rc.conf
fi

chmod o= /etc/fstab
chmod o= /etc/ftpusers
chmod o= /etc/group
chmod o= /etc/hosts
chmod o= /etc/hosts.allow
chmod o= /etc/hosts.equiv
chmod o= /etc/hosts.lpd
chmod o= /etc/inetd.conf
chmod o= /etc/login.access
chmod o= /etc/login.conf
chmod o= /etc/newsyslog.conf
chmod o= /etc/ssh/sshd_config
chmod o= /etc/sysctl.conf
chmod o= /etc/syslog.conf
chmod o= /etc/ttys
chmod o= /usr/bin/users
chmod o= /usr/bin/w
chmod o= /usr/bin/who
chmod o= /usr/bin/lastcomm
chmod o= /usr/sbin/jls
chmod o= /usr/bin/last
chmod o= /usr/sbin/lastlogin
chmod ugo= /usr/bin/rlogin
chmod ugo= /usr/bin/rsh

echo 'icmp_drop_redirect="YES"'		>> /etc/rc.conf
echo 'inetd_enable="NO"'		>> /etc/rc.conf
echo '#enable portmap when using NFS'	>> /etc/rc.conf
echo '#note that NFS is a big risk'	>> /etc/rc.conf
echo 'portmap_enable="NO"'		>> /etc/rc.conf
echo 'syslogd_flags="-ss"'		>> /etc/rc.conf
echo 'clear_tmp_enable="YES"'		>> /etc/rc.conf
echo 'sendmail_enable="NONE"'		>> /etc/rc.conf
echo 'sendmail_submit_enable="NO"'	>> /etc/rc.conf
echo 'sendmail_outbound_enable="NO"'	>> /etc/rc.conf
echo 'sendmail_msp_queue_enable="NO"'	>> /etc/rc.conf
echo 'tcp_drop_synfin="YES"'		>> /etc/rc.conf
echo 'mysql_args="--skip-networking"'	>> /etc/rc.conf
echo 'ntpdate_enable="YES"'		>> /etc/rc.conf 
echo 'ntpdate_flags="0.'"$lc"'.pool.ntp.org"'	>> /etc/rc.conf
echo '#http://www.pool.ntp.org/zone'	>> /etc/rc.conf

echo '#kern_securelevel_enable="YES"'	>> /etc/rc.conf
echo '#kern_securelevel="0"'		>> /etc/rc.conf
echo '#forget seculvl if ur gonna use Xorg (Desktop / GUI)' >>/etc/rc.conf

echo "security.bsd.see_other_uids=0"	>> /etc/sysctl.conf
echo 'net.inet.tcp.blackhole=2'		>> /etc/sysctl.conf
echo 'net.inet.udp.blackhole=1'		>> /etc/sysctl.conf
echo "net.inet.ip.random_id=1"		>> /etc/sysctl.conf
echo "#vfs.usermount=1"                  >> /etc/sysctl.conf
echo '#allow nonroot-users with shell access to issue the mount cmd' >>/etc/sysctl.conf
echo 'root' > /var/cron/allow
chmod 600 /var/cron/allow
chmod 600 /etc/crontab
chmod o= /etc/crontab
chmod o= /usr/bin/crontab

echo "root" > /var/at/at.allow
chmod o= /usr/bin/at
chmod o= /usr/bin/atq
chmod o= /usr/bin/atrm
chmod o= /usr/bin/batch


chmod o= /etc/fstab
chmod o= /etc/ftpusers
chmod o= /etc/group
chmod o= /etc/hosts
chmod o= /etc/hosts.allow
chmod o= /etc/hosts.equiv
chmod o= /etc/hosts.lpd
chmod o= /etc/inetd.conf
chmod o= /etc/login.access
chmod o= /etc/login.conf
chmod o= /etc/newsyslog.conf
chmod o= /etc/rc.conf
chmod o= /etc/ssh/sshd_config
chmod o= /etc/sysctl.conf
chmod o= /etc/syslog.conf
chmod o= /etc/ttys


# do this at single-user mode:
#	remove second tmp folder
#rm -r /var/tmp
#	create a virtual link from the location of the folder we just removed
#	to the real temp folder location
#	to maintain system stability
#ln -s /tmp /var/tmp
# --------------

if [ $createnewkernel = "yes" ]
then
#backup kernel:
cp -R /boot/kernel /boot/kernel.gn
	# boot old kernel after make install: escape to loader prompt (7) from boot menu, type:
	# boot kernel.gn

cd /usr/src/sys/i386/conf/
cp GENERIC MYKERNEL
echo "options         TCP_DROP_SYNFIN         # unusable for production webservers"		>> MYKERNEL

if [ $ics = "yes" ]
then
echo "for internet connection sharing:"		>> MYKERNEL
echo "options         IPSTEALTH               # Enable stealth forwarding"			>> MYKERNEL
echo "options IPFIREWALL"			>> MYKERNEL
echo "options IPFIREWALL_VERBOSE"		>> MYKERNEL
echo "options IPFIREWALL_VERBOSE_LIMIT=100"	>> MYKERNEL
echo "options IPDIVERT"				>> MYKERNEL
echo "device atapicam"                          >> MYKERNEL
echo "#for accessing atapi via scsi interface"  >> MYKERNEL
config MYKERNEL
cd ../compile/MYKERNEL; make cleandepend; make depend; make; make install
fi
fi
#for internet connection sharing:
if [ $ics = "yes" ]
then
echo 'named_enable="YES"' 		>> /etc/rc.conf
echo 'gateway_enable="YES"'		>> /etc/rc.conf
echo 'natd_program="/sbin/natd"'	>> /etc/rc.conf
echo 'natd_enable="YES"'		>> /etc/rc.conf
echo 'natd_flags="-f /etc/natd.conf"# Additional flags for natd.'		>> /etc/rc.conf

## natd configuration
echo 'interface "$eif" # external interface'	>> /etc/natd.conf
echo 'use_sockets yes'				>> /etc/natd.conf
echo 'same_ports yes'				>> /etc/natd.conf
echo 'log no'					>> /etc/natd.conf
echo '## port forwards'				>> /etc/natd.conf
echo '# http service'				>> /etc/natd.conf
echo '#redirect_port tcp 10.0.0.11:80 80'	>> /etc/natd.conf
fi

echo 'firewall_enable="YES"'			>> /etc/rc.conf
echo 'firewall_script="/etc/rc.firewall"' 	>> /etc/rc.conf
echo 'firewall_type="simple"'			>> /etc/rc.conf

chmod 600 /etc/rc.sysctl
chmod 600 /etc/rc.conf
chmod 600 /etc/sysctl.conf
chmod 600 /etc/syslog.conf
chmod 600 /etc/newsyslog.conf
chmod o= /etc/rc.conf
