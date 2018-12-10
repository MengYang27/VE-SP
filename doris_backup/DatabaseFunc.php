<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>
<body>
    <?php
      PrintForm();

     function OpenConn()
     {
      $conn = new mysqli("localhost", "root", "123456", "ve_test");
      return $conn;
     }

     function TruncateTable($tableName)//杀器！慎用！
     {
       $sql="truncate table ".$tableName;
       $conn = OpenConn();
       $result = $conn->query($sql);
       $conn->close();
       return $result;
     }


     function DeleteFromTable($tableName,$colName,$colValue)
     {
      $sql="delete from ".$tableName." where ".$colName." = ".$colValue;
      $conn = OpenConn();
      $result = $conn->query($sql);
      $conn->close();
      return $result;
     }

     function SelectWholeTable($tableName,$orderBy,$desc='desc')
     {
       $sql="select * from ". $tableName . " order by " . $orderBy." ".$desc;
       $conn = OpenConn();
       $results = $conn->query($sql);

       //print_r(mysqli_fetch_array($results));
       while($row = mysqli_fetch_row($results))
       {
         $result[]=$row;
       }
       $conn->close();
       return $result;
     }

     function SelectSigleCol($tableName,$colName)
     {
       $sql="select ". $colName ." from ". $tableName;
       $conn=OpenConn();
       $results=$conn->query($sql);
       while($row = mysqli_fetch_row($results))
       {
         $result[]=$row;
       }
       $conn->close();
       return $result;
     }

     function SelectSingleElement($tableName,$colName, $idName, $idValue)
     {
       $sql="select ". $colName ." from ". $tableName. " where ". $idName ."=" . $idValue;
       $conn=OpenConn();
       $results=$conn->query($sql);
       while($row = mysqli_fetch_row($results))
       {
         $result[]=$row;
       }
       $conn->close();
       return $result;
     }

     function SelectSigleRow($tableName,$colName,$colValue)
     {
       switch ($tableName) {
         case 'rainfo':
           $sql="select * from rainfo inner join raquestion on rainfo.raid=raquestion.raid inner join raanswer on rainfo.raid=raanswer.raid where rainfo."
           .$colName."=".$colValue;

           break;

         case 'rsinfo':
           $sql="select * from rsinfo inner join rsquestion on rsinfo.rsid=rsquestion.rsid inner join rsanswer on rsinfo.rsid=rsanswer.rsid where rsinfo."
           .$colName."=".$colValue;
         break;

        case 'mcsclinfo':
         $sql="select * from mcsclinfo inner join mcsclquestion on mcsclinfo.mcsclid=mcsclquestion.mcsclid inner join "
          . "mcsclanswer on mcsclinfo.mcsclid=mcsclanswer.mcsclid where mcsclinfo.".$colName."=".$colValue;
        break;

        case 'fiblinfo':
         $sql="select * from fiblinfo inner join fiblquestion on fiblinfo.fiblid=fiblquestion.fiblid inner join "
         . "fiblanswer on fiblinfo.fiblid=fiblanswer.fiblid where fiblinfo.".$colName."=".$colValue;
        break;

         default:
           echo 'wrong table name!';
           exit();
           break;
       }
       if($sql!='')
       {
         $conn=OpenConn();
         $results=$conn->query($sql);
         while($row = mysqli_fetch_row($results))
         {
           $result[]=$row;
         }
         $conn->close();
         return $result;
       }
       else
       {
           echo 'fail to set up sql query.';
           return 0;
       }
     }

     function UpdateTable($tableName,$alterArray,$conditionColName,$conditionValue)//key=columnName value=value
     {
       if(!empty($alterArray))
       {
         $sql="update ".$tableName." set ";
         foreach ($alterArray as $key => $value)
         {
           $sql .= $key. " = ".$value . ",";
         }
         $sql = substr($sql,0,strlen($sql)-1);
         $sql = $sql . " where " .$conditionColName. "=" .$conditionValue;
         $conn = OpenConn();
         $result = $conn->query($sql);
         $conn->close();
         return $result;
       }
       else
       {
          echo "传进来的数组没值！";
          exit();
       }
     }

     function CheckRedundant($tableName,$colName,$colValue)//return 0 means no redundant; return 1 means redundant
     {
       $sql="select * from ". $tableName . " where ".$colName."=".$colValue;
       $conn=OpenConn();
       $results=$conn->query($sql);
       while($row = mysqli_fetch_row($results))
       {
         $result[]=$row;
       }
       $conn->close();
       if(isset($result))
       return 1;
       else
       return 0;
     }

     function Insert_RAINFO($title,$isFrequency,$isDifficult,$isNew,$isJJ,$publishDate,$updateDate,$category)
     {
       $sql="insert into rainfo(title,isfrequency,isdifficult,isnew,isjj,publishdate,updatedate,category)"
          . " values('". $title ."',".$isFrequency.",$isDifficult,".$isNew.",".$isJJ.",'".$publishDate."','".$updateDate."','".$category."');";
       $conn=OpenConn();
       $result=$conn->query($sql);
       if($result!=0)
       {
        $currentID=ReturnMaxID('rainfo','raid');
       }
       $conn->close();
       return $currentID;
     }

     function ReturnMaxID($tableName,$colName)
     {
       $sql="select max(".$colName.") from ".$tableName;
       $conn=OpenConn();
       $result=$conn->query($sql);
       while($row=$result->fetch_row())
       {
            return $row[0];
       }
     }

     function Insert_RAQuestion($raID,$content)
     {
       $sql="insert into raquestion(raid,content) values(".$raID.",'".$content."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }

     function Insert_RAAnswer($raID,$audioPath,$raComment)
     {
       $sql="insert into raanswer(raid,audiopath,racomment) values(".$raID.",'".$audioPath."','".$raComment."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }

     function Insert_RSINFO($title,$isFrequency,$isDifficult,$isNew,$isJJ,$publishDate,$updateDate,$category)
     {
       $sql="insert into rsinfo(title,isfrequency,isdifficult,isnew,isjj,publishdate,updatedate,category)"
          . " values('". $title ."',".$isFrequency.",$isDifficult,".$isNew.",".$isJJ.",'".$publishDate."','".$updateDate."','".$category."');";
       $conn=OpenConn();
       $result=$conn->query($sql);
       if($result!=0)
       {
        $currentID=ReturnMaxID('rsinfo','rsid');
       }
       $conn->close();
       return $currentID;
     }

     function Insert_RSQuestion($rsID,$audioPath)
     {
       $sql="insert into rsquestion(rsid,audiopath) values(".$rsID.",'".$audioPath."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }

     function Insert_RSAnswer($rsID,$transcript,$wordCount,$rsComment)
     {
       $sql="insert into rsanswer(rsid,transcript,wordcount,rscomment) values(".$rsID.",'".$transcript."',".$wordCount.",'".$rsComment."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }

     function Insert_MCSCLINFO($title,$isFrequency,$isDifficult,$isNew,$isJJ,$publishDate,$updateDate,$category)
     {
       $sql="insert into mcsclinfo(title,isfrequency,isdifficult,isnew,isjj,publishdate,updatedate,category)"
          . " values('". $title ."',".$isFrequency.",$isDifficult,".$isNew.",".$isJJ.",'".$publishDate."','".$updateDate."','".$category."');";
       $conn=OpenConn();
       $result=$conn->query($sql);
       if($result!=0)
       {
        $currentID=ReturnMaxID('mcsclinfo','mcsclid');
       }
       $conn->close();
       return $currentID;
     }

     function Insert_MCSCLQuestion($mcsclID,$content,$audioPath)
     {
       $sql="insert into mcsclquestion(mcsclid,content,audiopath) values(".$mcsclID.",'".$content."','".$audioPath."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }

     function Insert_MCSCLAnswer($mcsclID,$transcript,$explanation,$mcsclComment)
     {
       $sql="insert into mcsclanswer(mcsclid,transcript,explanation,mcsclcomment) values(".$mcsclID.",'".$transcript."','".$explanation."','".$mcsclComment."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }

     function Insert_FIBLINFO($title,$isFrequency,$isDifficult,$isNew,$isJJ,$publishDate,$updateDate,$category)
     {
       $sql="insert into fiblinfo(title,isfrequency,isdifficult,isnew,isjj,publishdate,updatedate,category)"
          . " values('". $title ."',".$isFrequency.",$isDifficult,".$isNew.",".$isJJ.",'".$publishDate."','".$updateDate."','".$category."');";
       $conn=OpenConn();
       $result=$conn->query($sql);
       if($result!=0)
       {
        $currentID=ReturnMaxID('fiblinfo','fiblid');
       }
       $conn->close();
       return $currentID;
     }

     function Insert_FIBLQuestion($fiblID,$content,$audioPath)
     {
       $sql="insert into fiblquestion(fiblid,content,audiopath) values(".$fiblID.",'".$content."','".$audioPath."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }

     function Insert_FIBLAnswer($fiblID,$answers,$fiblComment)
     {
       $sql="insert into fiblanswer(fiblid,answers,fiblcomment) values(".$fiblID.",'".$answers."','".$fiblComment."')";
       $conn=OpenConn();
       $result=$conn->query($sql);
       $conn->close();
       return $result;
     }


     function PrintForm()
     {?>
       <div>
       <form id="mainForm"  action="l_question.php" method="get">
         <?php

         //$result=SelectWholeTable('rainfo','raid');

         //$result=SelectSigleRow('rainfo','raid','1');

         // FOR RS
         //$result=Insert_RSINFO('testTitle1',1,0,0,0,'2017-10-11','2018-01-02','9-3,9-2,9-1');
         //$result=Insert_RSQuestion(1,'testPath');
         //$result=Insert_RSAnswer(1,'testTranscript',100,'testComment');
         //$result=SelectSigleRow('rsinfo','rsid',1);
         // END RS

         // FOR MCSCL
         //$result=Insert_MCSCLINFO('testTitle2',1,0,0,0,'2017-10-11','2018-01-02','9-3,9-2,9-1');
         //$result=Insert_MCSCLQuestion(1,'testComment','testPath');
         //$result=Insert_MCSCLAnswer(1,'testTranscript','testExplanation','testComment');
         //$result=SelectSigleRow('mcsclinfo','mcsclid',1);
         // END MCSCL

         // FOR FIBL
         //$result=Insert_FIBLINFO('testTitle2',1,0,0,0,'2017-10-11','2018-01-02','9-3,9-2,9-1');
         //$result=Insert_FIBLQuestion(1,'testComment','testPath');
         //$result=Insert_FIBLAnswer(1,'answer1,answer2,answer3','testComment');
         //$result=SelectSigleRow('fiblinfo','fiblid',1);
         // END FIBL

         //print_r($result);

         //$result=TruncateTable('rainfo');
         //print_r($result);
         //$result=CheckRedundant('rainfo','raid',1);

         $result1=Insert_RAQuestion(3,'testContent3');
         print_r($result1);

         $result2=Insert_RAAnswer(3,'testPath3','testComment3');
         print_r($result2);

         //$result=Select_SigleCol('rainfo','title');

         //$aArray = array('title' =>'\'testTitle3\'' ,'isFrequency'=>'1');//bit不加单引号
         //$result=UpdateTable('RAINFO',$aArray,'RAID',1);

         //$result=DeleteFromTable('rainfo','raid',2);

         //$title,$isFrequency,$isDifficult,$isNew,$isJJ,$publishDate,$updateDate,$category

         $result=Insert_RAINFO('testTitle3',1,0,0,0,'2017-10-11','2018-01-02','9-3,9-2,9-1');
         print_r($result);
         //$title='testTile100';
         //$is1=0;
         //$is2=1;
         //$is3=0;
         //$is4=1;
         //$pDate='2017-10-1';
         //$uDate='2018-1-02';
         //$cate='9-3,9-2,9-1';
         //$result=Insert_RAINFO($title,$is1,$is2,$is3,$is4,$pDate,$uDate,$cate);


         //print_r(get_extension_funcs('mysqli'));
         ?>
       </form>
       </div>
     <?php
     }
     ?>
</body>

</html>
<?php
//disconnectDB($result, $db);
?>
