import sys,os

if os.path.exists("LINK_DIFF"):
    os.system("rm -rf LINK_DIFF")
os.mkdir("LINK_DIFF")

new_url_file = open("LINK_DIFF/new_url_file.txt",'w')
old_url_file = open("LINK_DIFF/old_url_file.txt",'w')
new_link_file = open("LINK_DIFF/new_link_file.txt",'w')
old_link_file = open("LINK_DIFF/old_link_file.txt",'w')
new_file = open("LINK_DIFF/new_file.txt","w")
old_file = open("LINK_DIFF/old_file.txt","w")
summery_file = open("LINK_DIFF/summery.txt","w")
diff_files={}
diff_item={}
diff_pack_dict = {}

split_word=" "

total_fromurl_new=0
total_fromurl_old=0
total_tourl_new = 0
total_tourl_old = 0
diff_pack_num = 0
add_tourl = 0
delete_tourl = 0

def same_len(str1,str2):
    len1 = len(str1)
    len2 = len(str2)
    count = 0
    while count < len1 and count < len2:
        if str1[count] != str2[count]:
            return count
        count = count + 1
    if len1 > len2:
        return len2
    return len1


def diff_two_dict2(new_item,old_item,file):
    max = -1
    i = 0
    target_old=-1 
    target_new=0
    temp_dict = {}
    temp_dict2 = {}
    while i < len(new_item):
        j = 0 
        max = -1
        while j < len(old_item):
            if temp_dict.get(j) != None:
                j = j + 1
                continue
            same =  same_len(new_item[i],old_item[j])
            if same > max:
                max = same
                target_new = i
                target_old = j
            j = j + 1
        if max != -1:
            temp_dict[target_old]="1"
            temp_dict2[target_new]="1"
            file.write(new_item[target_new].strip() + "~EOF!" + old_item[target_old].strip() + "\n")
        i = i + 1
    i = 0
    while i < len(old_item):
        if temp_dict.get(i) == None:
            file.write("NONE~EOF!"+old_item[i].strip()+"\n")
        i = i + 1
           
def diff_two_dict3(new_item,old_item,file):
    max = -1
    i = 0
    target_new=-1 
    target_old=0
    temp_dict = {}
    temp_dict2 = {}
    while i < len(old_item):
        j = 0 
        max = -1
        while j < len(new_item):
            if temp_dict.get(j) != None:
                j = j + 1
                continue
            same =  same_len(old_item[i],new_item[j])
            if same > max:
                max = same
                target_old = i
                target_new = j
            j = j + 1
        if max != -1:
            temp_dict[target_new]="1"
            temp_dict2[target_old]="1"
            file.write(new_item[target_new].strip() + "~EOF!" + old_item[target_old].strip() + "\n")
        i = i + 1
    i = 0
    while i < len(new_item):
        if temp_dict.get(i) == None:
            file.write(new_item[i].strip() + "~EOF!NONE\n")
        i = i + 1

def print_diff_item(new_item, old_item, file):
    if len(new_item) == len(old_item):
        count = 0
        while count < len(new_item):
            file.write(new_item[count].strip()+"~EOF!"+old_item[count])
            count = count + 1
        return
    if len(new_item) < len(old_item):
        diff_two_dict2(new_item,old_item, file)
    if len(old_item) < len(new_item):
        diff_two_dict3(new_item,old_item, file)


def extract_diff_file(file_path):
    global total_fromurl_new
    global total_tourl_new
    global total_fromurl_old
    global total_tourl_old
    global delete_tourl
    global add_tourl
    global diff_pack_num
    new_dict = {}
    old_dict = {}
    file = open(file_path,"r")
    
    for line in file:
        if line[0] == '<':
            array = line[2:].split(split_word)
            if len(array) >= 2:
                key = array[0]+array[1]
                if new_dict.get(key) != None:
                    new_dict[key].append(line[2:])
                else:
                    new_item = []
                    new_dict[key] = new_item
                    new_dict[key].append(line[2:])
            continue
        if line[0] == '>':
            array = line[2:].split(split_word)
            if len(array) > 2:
                key = array[0] + array[1]
                if old_dict.get(key) != None:
                    old_dict[key].append(line[2:])
                else:
                    old_item = []
                    old_dict[key] = old_item
                    old_dict[key].append(line[2:])
            continue
    temp_file = open("LINK_DIFF/.temp.diff.file","w") 
    for key in new_dict:
        if old_dict.get(key) != None:
            print_diff_item(new_dict[key], old_dict[key], temp_file)
        else:
            i = 0
            new_item = new_dict[key]
            while i < len(new_item):
                new_link_file.write(new_item[i])
                temp_array = new_item[i].split(split_word)
                if len(temp_array) > 1 and diff_pack_dict.get(temp_array[0]) == None:
                    diff_pack_num = diff_pack_num + 1
                    diff_pack_dict[temp_array[0]] = ""
                add_tourl = add_tourl + 1
                i = i + 1
    for key in old_dict:
        if new_dict.get(key) == None:
            i = 0
            old_item = old_dict[key]
            while i < len(old_item):
                old_link_file.write(old_item[i])
                temp_array = old_item[i].split(split_word)
                if len(temp_array) > 1 and diff_pack_dict.get(temp_array[0]) == None:
                    diff_pack_num = diff_pack_num + 1
                    diff_pack_dict[temp_array[0]] = ""
                delete_tourl = delete_tourl + 1
                i = i + 1

def extract_dict_from_line(str):
    dict = {}
    if len(str) == 0:
        return dict
    string = ""
    if str[0] == '[':
        string = str[1:len(str.strip())-1]
    else :
        string = str
    array = string.strip().split(split_word)
    for item in array:
        key_value = item.split("=");
        if len(key_value) == 0:
            continue
        if len(key_value) == 1:
            dict[key_value[0]] = ""
        if len(key_value) == 2:
            dict[key_value[0]] = key_value[1]
        if len(key_value) > 2:
            i = 1
            value_array=[]
            while i < len(key_value):
                value_array.append(key_value[i]) 
                i = i + 1
            dict[key_value[0]] = '='.join(value_array)             
    return dict

def diff_two_dict(new_dict, old_dict):
    global total_fromurl_new
    global total_tourl_new
    global total_fromurl_old
    global total_tourl_old
    global delete_tourl
    global add_tourl
    if new_dict.get("url") != None and old_dict.get("url") == None:
        if new_dict.get("link") != None:
            array = []
            array.append("url="+new_dict["url"])
            array.append("link="+new_dict["link"])
            for key in new_dict:
                if key != "url" and key != "link":
                    array.append(key+"="+new_dict[key])
            new_url_file.write(split_word.join(array)+"\n")
        return

    if old_dict.get("url") != None and new_dict.get("url") == None:
        if old_dict.get("link") != None:
            array = []
            array.append("url="+old_dict["url"])
            array.append("link="+old_dict["link"])
            for key in old_dict:
                if key != "url" and key != "link":
                    array.append(key+"="+old_dict[key])
            old_url_file.write(split_word.join(array)+"\n")
        return

    if old_dict.get("url") == None and new_dict.get("url") == None:
        return
    if new_dict["url"] != old_dict["url"]:
        if new_dict.get("link") != None:
            array = []
            array.append("url="+new_dict["url"])
            array.append("link="+new_dict["link"])
            for key in new_dict: 
                if key != "url" and key != "link":
                    array.append(key+"="+new_dict[key])
            new_url_file.write(split_word.join(array)+"\n")
        if old_dict.get("link") != None:
            array = []
            array.append("url="+old_dict["url"])
            array.append("link="+old_dict["url"])
            for key in old_dict:
                if key != "url" and key != "link":
                    array.append(key+"="+old_dict[key])
            old_url_file.write(split_word.join(array)+"\n")
        return

    if new_dict.get("link") != None and old_dict.get("link") == None:
        array = []
        array.append("url="+new_dict["url"])
        array.append("link="+new_dict["link"])
        for key in new_dict:
            if key != "url" and key != "link":
                array.append(key+"="+new_dict[key])
        new_link_file.write(split_word.join(array)+"\n")
        add_tourl = add_tourl + 1
        return

    if old_dict.get("link") != None and new_dict.get("link") == None:
        array = []
        array.append("url="+old_dict["url"])
        array.append("link=")+old_dict["link"]
        for key in old_dict:
            if key != "url" and key != "link":
                array.append(key+"="+old_dict[key])
        old_link_file.write(split_word.join(array)+"\n")
        delete_tourl = delete_tourl + 1
        return

    if new_dict["link"] != old_dict["link"]:
        array = []
        array.append("url="+new_dict["url"])
        array.append("link="+new_dict["link"])
        for key in new_dict:
            if key != "url" and key != "link":
                array.append(key+"="+new_dict[key])
        new_link_file.write(split_word.join(array)+"\n")
        add_tourl = add_tourl + 1
        array = []
        array.append("url="+old_dict["url"])
        array.append("link="+old_dict["link"])
        for key in old_dict:
            if key != "url" and key != "link":
                array.append(key+"="+old_dict[key])
        old_link_file.write(split_word.join(array)+"\n")
        delete_tourl = delete_tourl + 1
        return

    for key in new_dict:
        if key != "url" and key != "link":
            array = []
            array.append("url="+new_dict["url"])
            array.append("link="+new_dict["link"])
            if new_dict.get("anchor") != None and old_dict.get("anchor") != None and new_dict["anchor"] == old_dict["anchor"]:
                array.append("anchor="+new_dict["anchor"])
            else :
                array.append("anchor=")
            if key not in old_dict:
                array.append(key+"="+new_dict[key])
                array.append(key+"=")
                if key+"_diff.txt" in diff_files:
                    diff_files[key+"_diff.txt"].write('\t'.join(array)+"\n")
                    diff_item[key] = diff_item[key] + 1
                else:
                    diff_files[key+"_diff.txt"] = open("LINK_DIFF/"+key+"_diff.txt",'w')
                    diff_files[key+"_diff.txt"].write('\t'.join(array)+"\n")
                    diff_item[key] = 1
                continue
            if new_dict[key] != old_dict[key]:
                array.append(key+"="+new_dict[key])
                array.append(key+"="+old_dict[key])
                if key+"_diff.txt" in diff_files:
                    diff_files[key+"_diff.txt"].write('\t'.join(array)+"\n")
                    diff_item[key] = diff_item[key] + 1
                else:
                    diff_files[key+"_diff.txt"] = open("LINK_DIFF/"+key+"_diff.txt",'w')
                    diff_files[key+"_diff.txt"].write('\t'.join(array)+"\n")
                    diff_item[key] = 1
                continue

    for key in old_dict:
        if key != "url" and key != "link":
            array = []
            array.append("url")
            array.append("link")
            if key not in new_dict:
                array.append(key+"=")
                array.append(key+"="+old_dict[key])
                if key+"_diff.txt" in diff_files:
                    diff_files[key+"_diff.txt"].write('\t'.join(array)+"\n")
                    diff_item[key] = diff_item[key] + 1
                else:
                    diff_files[key+"_diff.txt"] = open("LINK_DIFF/"+key+"_diff.txt",'w')
                    diff_files[key+"_diff.txt"].write('\t'.join(array)+"\n")
                    diff_item[key] = 1
                       
                
                
def diff_machine(diff_file):
    global total_fromurl_new
    global total_tourl_new
    global total_fromurl_old
    global total_tourl_old
    global delete_tourl
    global add_tourl
    global diff_pack_num
    last_flag = -1
    last_dict = []
    for line in diff_file:
        array = line.strip().split("~EOF!")
        if len(array) == 2:
            if array[0] == "NONE":
                old_link_file.write(array[1]+"\n")
                temp_array = array[1].split(split_word)
                if len(temp_array) > 1 and diff_pack_dict.get(temp_array[0]) == None:
                    diff_pack_num = diff_pack_num + 1
                    diff_pack_dict[temp_array[0]] = ""
                delete_tourl = delete_tourl + 1
                continue
            if array[1] == "NONE":
                new_link_file.write(array[0]+"\n")
                temp_array = array[0].split(split_word)
                if len(temp_array) > 0 and diff_pack_dict.get(temp_array[0]) == None:
                    diff_pack_num  = diff_pack_num + 1
                    diff_pack_dict[temp_array[0]]  = ""
                add_tourl = add_tourl + 1
                continue
            temp_array = array[0].split(split_word)
            if len(temp_array) > 0 and diff_pack_dict.get(temp_array[0]) == None:
                diff_pack_num = diff_pack_num + 1
                diff_pack_dict[temp_array[0]] = ""
            temp_array = array[1].split(split_word)
            if len(temp_array) > 0 and diff_pack_dict.get(temp_array[0]) == None:
                diff_pack_num = diff_pack_num + 1
                diff_pack_dict[temp_array[0]] = ""
            new_dict = extract_dict_from_line(array[0])
            old_dict = extract_dict_from_line(array[1])
            diff_two_dict(new_dict,old_dict)            


def diff_first_time(file1, file2):
    new_dict = {}
    url_dict = {}
    old_dict = {}
    global total_fromurl_new
    global total_tourl_new
    global total_fromurl_old
    global total_tourl_old
    global delete_tourl
    global add_tourl
    global diff_pack_num
    for line in file1:
        array=line.split(split_word)
        if len(array) > 1:
            if url_dict.get(array[0]) == None :
                total_fromurl_new = total_fromurl_new + 1
                url_dict[array[0]] = ""
        if len(array) > 2:
            new_dict[array[0]+array[1]] = 0
            total_tourl_new = total_tourl_new + 1
    for line in file2:
        array=line.split(split_word)
        if len(array) > 1:
            if old_dict.get(array[0]) == None :
                total_fromurl_old = total_fromurl_old + 1
                old_dict[array[0]] = ""
        if len(array) > 2:
            if array[0]+array[1] in new_dict:
                new_dict[array[0]+array[1]] = 1
                old_file.write(line)
            else:
                old_link_file.write(line)
                delete_tourl = delete_tourl + 1
            total_tourl_old = total_tourl_old + 1
    file1.seek(0)
    for line in file1:
        array = line.split(split_word)
        if len(array) > 2:
            if new_dict[array[0]+array[1]] == 1:
                new_file.write(line)
            else:
                new_link_file.write(line)
                temp_array = line.split(split_word)
                if len(temp_array) > 0 and diff_pack_dict.get(temp_array[0]) == None:
                    diff_pack_num = diff_pack_num + 1
                    diff_pack_dict[temp_array[0]] = ""
                add_tourl = add_tourl + 1
    file1.close()
    file2.close()            
    
def print_summery():
    string =          "------------------------------------------------------------------\n"
    string = string + "------------------------------SUMMERY-----------------------------\n"
    string = string + "total_from_url_new : " + str(total_fromurl_new)+ "\t\ttotal_from_url_old : " + str(total_fromurl_old) + "\n"
    string = string + "total_links_new : " + str(total_tourl_new)+"\t\ttotal_links_old : " + str(total_tourl_old) + "\n"
    string = string + "diff_pack_num : " + str(diff_pack_num) + "\n"
    string = string + "------------------------------------------------------------------\n"
    string = string + "-------------------------------DIFF-------------------------------\n"
    string = string + "add_links_num : " + str(add_tourl)+"\t\tdelete_links_num : " + str(delete_tourl) + "\n"
    for key in diff_item:
        string = string + key + " : " + str(diff_item[key]) + "\n" 
    string = string + "------------------------------------------------------------------\n"
    string = string + "-------------------------------END--------------------------------\n"
#print string
    summery_file.write(string)
   

if __name__ == "__main__":
    if len(sys.argv) < 3:
        print "Usage : python diff.py split_word file1 file2"
        exit(0)
    split_word = sys.argv[1]
    input_file1 = open(sys.argv[2])
    input_file2 = open(sys.argv[3]) 
    diff_first_time(input_file1, input_file2)
    new_file.close()
    old_file.close()
    work_path=sys.path[0]
    os.system(sys.path[0]+"/Sort "+"LINK_DIFF/new_file.txt > LINK_DIFF/new_file_sort.txt")
    os.system(sys.path[0]+"/Sort "+"LINK_DIFF/old_file.txt > LINK_DIFF/old_file_sort.txt")
    os.system("diff LINK_DIFF/new_file_sort.txt LINK_DIFF/old_file_sort.txt > LINK_DIFF/diff.result")
    extract_diff_file("LINK_DIFF/diff.result")
    diff_file = open("LINK_DIFF/.temp.diff.file")
    diff_machine(diff_file)
    os.system("rm LINK_DIFF/new_file_sort.txt")
    os.system("rm LINK_DIFF/old_file_sort.txt")
    os.system("rm LINK_DIFF/diff.result")
    os.system("rm LINK_DIFF/new_file.txt")
    os.system("rm LINK_DIFF/old_file.txt")

   # os.system("rm LINK_DIFF/.temp.diff.file")
    print_summery()
