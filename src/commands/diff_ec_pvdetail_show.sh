path=$1
url=$2
file1="$path""pvdetail_1.txt"
file2="$path""pvdetail_2.txt"

awk '{
		if ( $1 == "'${url}'")
		{	
			printf("%s\n",$1);
			for(x=2;x<NF;x++)
			{
				printf("%s\t",$x);
			}
			printf("%s\n",$NF);
			exit;
		}
}' $file1

awk '{
		if ( $1 == "'${url}'")
		{	
			for(x=2;x<NF;x++)
			{
				printf("%s\t",$x);
			}
			printf("%s\n",$NF);
			exit;
		}
}' $file2
