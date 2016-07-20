<?php


function check_auth_ldap($login,$password)
{
  $l=trim($login);
  $p=trim($password);
  if (($p=="") || ($l==""))
    return false;
  if (!($ldapconn=@ldap_connect("127.0.0.1")))
    return false;
  if (!@ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3))
    return false;
  if ($ldapbind=@ldap_bind($ldapconn,"uid=$l,ou=Users,dc=itcpiovene,dc=it",$p))
    return true;
  else
    return false;
}

?>
