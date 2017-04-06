BEGIN{
    print "[FEATURESET]"
}
{
   if($1 == "FEATURESET_SIZE")
      print $0
}
END{
   print "        SERIA_IN_CONFIG_PATH : ./conf/"
   print "        SERIA_IN_CONFIG_FILE : seria_in_config"
   print "        SERIA_OUT_CONFIG_PATH : ./conf/"
   print "        SERIA_OUT_CONFIG_FILE : seria_out_config"
   print "        FETURE_CONFIG_FILE_NAME : ./conf/feature.conf"
}
