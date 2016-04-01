function confirm_delete()
{
    var r=confirm("Are you sure?");
    if (r==true)
    {
      return true;
    }
    else
    {
      return false;
    }
}