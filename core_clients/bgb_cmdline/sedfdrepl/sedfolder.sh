#!/bin/bash
mkdir ${SAVED:=saved};
var1=$1;
var2=$2;
var3=$3;
#echo "s/$var2/$var3/g $file"
for file in `ls $var1` ;do 
if [ ! -f "$file" ]      # Check if file exists.
  then
    echo "$file invalid/does not exist."; echo
    continue                # On to next.
   fi

sed -e 's/'"$var2"'/'"$var3"'/g' "$file" > "$file.tmp";
if	[ -s "$file.tmp" ]
then
echo "Matched in $file";
cp "$file" "$SAVED/`date +%s`.$file";
     cp "$file.tmp" "$file";
fi;
rm "$file.tmp";
done;

exit;


