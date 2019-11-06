/*
---------------------------------------------------------
Clean UP SQL Statement
---------------------------------------------------------
                                                          
 ####  #####   ##   #####     #    #   ##   #####   ####  
#        #    #  #  #    #    #    #  #  #  #    # #      
 ####    #   #    # #    #    #    # #    # #    #  ####  
     #   #   ###### #####     # ## # ###### #####       # 
#    #   #   #    # #   #     ##  ## #    # #   #  #    # 
 ####    #   #    # #    #    #    # #    # #    #  ####  
                                                   

               ________
          _,.-Y  |  |  Y-._
      .-~"   ||  |  |  |   "-.
      I" ""=="|" !""! "|"[]""|     _____
      L__  [] |..------|:   _[----I" .-{"-.
     I___|  ..| l______|l_ [__L]_[I_/r(=}=-P
    [L______L_[________]______j~  '-=c_]/=-^
     \_I_j.--.\==I|I==_/.--L_]
       [_((==)[`-----"](==)j
          I--I"~~"""~~"I--I
          |[]|         |[]|
          l__j         l__j
          |!!|         |!!|
          |..|         |..|
          ([])         ([])
          ]--[         ]--[
          [_L]         [_L]  
         /|..|\       /|..|\
        `=}--{='     `=}--{='
       .-^--r-^-.   .-^--r-^-.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

*/


DROP TABLE IF EXISTS admin_account;
DROP TABLE IF EXISTS announcement;
DROP TABLE IF EXISTS reply;
DROP TABLE IF EXISTS thread;
DROP TABLE IF EXISTS complain;
DROP TABLE IF EXISTS message;


DROP TABLE IF EXISTS enroll;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS attempts;
DROP TABLE IF EXISTS quiz;
DROP TABLE IF EXISTS video;
DROP TABLE IF EXISTS markers;


DROP TABLE IF EXISTS tutor;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS tc;

/*DELETE FROM module;*/
DROP TABLE IF EXISTS module;

/*DELETE FROM account;*/
DROP TABLE IF EXISTS account;

