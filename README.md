# Everybody Codes

My solutions to the [Everybody Codes](https://everybody.codes) puzzles.

To prevent hosting any puzzle data, I will only have the sample data commited to this repository.

## Bash Commands (using Mac)

If you are using this as a base for starting your own Everybody Codes repository, or even if you just want to get your day started more quickly, add this to your .bash_profile to jumpstart your day. This will assume you are using the structure of /Users/{name}/Everybody Codes/YYYY/DD.php. Look for # REPLACE

### If you only want to create your files for the day, use the following:

```
function ec() {
	# Expected Operations:
	# "ec" - opens Everybody Codes folder, creates a file for today in this year, plus blank data files (and folders that need to exist)
	# "ec 5" - opens Everybody Codes folder, creates a file for day 05 in this year, plus blank data files (and folders that need to exist)
	# "ec 12 2024" - opens Everybody Codes folder, creates a file for day 12 in the year 2024 plus blank data files (and folders that need to exist)
	# "ec o" - opens Everybody Codes folder withing the IDE/Editor ONLY

	# REPLACE with your name, and uncomment or add your IDE/Editor of choice
    cd /Users/fischfood/Everybody\ Codes;
    # open -a "Phpstorm.app" .;
    # open -a "Sublime Text.app" .;
    # open -a "Visual Studio Code.app" .;
    # END REPLACE #

	DAY=$1
	YEAR=$2

	# If first input is "o", just open
	# otherwise, create stuff
	# If first input is "o", just open
	# otherwise, create stuff
	if [ "$1" != "o" ]
	then

		# If a year isn't set, set it to this year
		# Check if the selected years folder exists, and create if missing.
		# Go into that folder
		if [ ! $YEAR ]
		then
			YEAR="$(date +'%Y')";
		fi

		if [ ! -d $YEAR ]
		then
			mkdir $YEAR;
		fi
		cd $YEAR;


		# If this is the first time making the year folder, make the data folder too
		if [ ! -d "data" ]
		then
			mkdir "data";
		fi

		# If a day isn't set, set it to today
		if [ ! $DAY ]
		then
			DAY="$(date +'%d')";
		fi

		# Make it two digits for Finder sorting
		DAY_SHORT=$DAY
		DAY=$(printf "%02d" $DAY)

		# Clone the starting point php file and replace the date. Make the data text files
		cp ../starting-point.php ./$DAY.php;
		sed -i '' "s/DAY_SHORT/$DAY_SHORT/g" ./$DAY.php;
		sed -i '' "s/DAY/$DAY/g" ./$DAY.php;

		cd data; mkdir $DAY;

		# Make the data files, one sample and true for each of the three parts
		touch "$DAY/data-01.txt";
		touch "$DAY/data-02.txt";
		touch "$DAY/data-03.txt";
		touch "$DAY/data-01-sample.txt";
		touch "$DAY/data-02-sample.txt";
		touch "$DAY/data-03-sample.txt";
	fi
}
```

## File Watching

If you are using a file watcher, such as the extension through Visual Studio Code, you can have the code auto run for you.
Using that extension, open up your settings.json file and add this snippet to filewatcher.commands:

```
"filewatcher.commands": [
	{
		"match": "Everybody Codes/(.*)/(.*)\\.php",
		"isAsync": true,
		"cmd": "cd \"${fileDirname}\"; pwd; php -r 'require \"${fileBasename}\";' ",
		"event": "onFileChange"
	}
],
```

Now every time you save a YYYY/DD.php file, it will auto run for you. If you don't see the window, go to Terminal in the top bar, and select "New Terminal". Once this appears, switch to the OUTPUT tab, and change the dropdown on the right to "File Watcher"
