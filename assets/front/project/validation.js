var basepath,steps_loading_image;
/*name or title validation*/
function V1_funNameCheck(name)
{
    var namepattern=/^[a-zA-Z]+[a-zA-Z ]+$/;
    var err_msg='';
    if(name=='')
    {   
        err_msg='Enter name';
    }
    else if(name!='' && !namepattern.test(name))
    {
        err_msg='Enter valid name';
    }
    return err_msg;
}
/*empty check validation*/
function V1_funEmptyCheck(inputvalue)
{
    var err_msg='';
    if(inputvalue=='')
    {
        err_msg='Field should not be empty';
    }
    return err_msg;
}




 


