--TEST--
mb_strpos() 
--SKIPIF--
<?php extension_loaded('mbstring') or die('skip mbstring not available'); ?>
--FILE--
<?php
// TODO: Add more encodings

//$debug=true;
ini_set('include_path','.');
include_once('common.inc');


// Test string
$euc_jp = '0123����ʸ��������ܸ�Ǥ���EUC-JP��ȤäƤ��ޤ���0123���ܸ�����ݽ�����';

$slen = mb_strlen($euc_jp, 'EUC-JP');
echo "String len: $slen\n";

// EUC-JP - With encoding parameter
mb_internal_encoding('UTF-8') or print("mb_internal_encoding() failed\n");

echo  "== POSITIVE OFFSET ==\n";

print  mb_strpos($euc_jp, '���ܸ�', 0, 'EUC-JP') . "\n";
print  mb_strpos($euc_jp, '0', 0,     'EUC-JP') . "\n";
print  mb_strpos($euc_jp, 3, 0,       'EUC-JP') . "\n";
print  mb_strpos($euc_jp, 0, 0,       'EUC-JP') . "\n";
print  mb_strpos($euc_jp, '���ܸ�', 15, 'EUC-JP') . "\n";
print  mb_strpos($euc_jp, '0', 15,     'EUC-JP') . "\n";
print  mb_strpos($euc_jp, 3, 15,       'EUC-JP') . "\n";
print  mb_strpos($euc_jp, 0, 15,       'EUC-JP') . "\n";


// Negative offset
echo "== NEGATIVE OFFSET ==\n";

print mb_strpos($euc_jp, '���ܸ�', -15, 'EUC-JP') . "\n";
print mb_strpos($euc_jp, '0', -15,     'EUC-JP') . "\n";
print mb_strpos($euc_jp, 3, -15,       'EUC-JP') . "\n";
print mb_strpos($euc_jp, 0, -15,       'EUC-JP') . "\n";
print mb_strpos($euc_jp, 0, -43,       'EUC-JP') . "\n";


// Invalid offset - should return false with warning
print ("== INVALID OFFSET ==\n");

$r =  mb_strpos($euc_jp, '���ܸ�', 44, 'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r =  mb_strpos($euc_jp, '���ܸ�', 50, 'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r =  mb_strpos($euc_jp, '0', 50,     'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r =  mb_strpos($euc_jp, 3, 50,       'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r =   mb_strpos($euc_jp, 0, 50,       'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r = mb_strpos($euc_jp, '���ܸ�', -50, 'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r = mb_strpos($euc_jp, '0', -50,     'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r = mb_strpos($euc_jp, 3, -50,       'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r = mb_strpos($euc_jp, 0, -50,       'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";
$r = mb_strpos($euc_jp, 0, -44,       'EUC-JP');
($r === FALSE) ? print "OK_INVALID_OFFSET\n"     : print "NG_INVALID_OFFSET\n";

// Out of range - should return false
print ("== OUT OF RANGE ==\n");

$r =  mb_strpos($euc_jp, '���ܸ�', 40, 'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";
$r =  mb_strpos($euc_jp, '0', 40,     'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";
$r =  mb_strpos($euc_jp, 3, 40,       'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";
$r =   mb_strpos($euc_jp, 0, 40,       'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";
$r =  mb_strpos($euc_jp, '���ܸ�', -3, 'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";
$r =  mb_strpos($euc_jp, '0', -3,     'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";
$r =  mb_strpos($euc_jp, 3, -3,       'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";
$r =   mb_strpos($euc_jp, 0, -3,       'EUC-JP');
($r === FALSE) ? print "OK_OUT_RANGE\n"     : print "NG_OUT_RANGE\n";


// Non-existent
echo "== NON-EXISTENT ==\n";

$r = mb_strpos($euc_jp, '�ڹ��', 0, 'EUC-JP');
($r === FALSE) ? print "OK_STR\n"     : print "NG_STR\n";
$r = mb_strpos($euc_jp, "\n",     0, 'EUC-JP');
($r === FALSE) ? print "OK_NEWLINE\n" : print "NG_NEWLINE\n";


// EUC-JP - No encoding parameter
echo "== NO ENCODING PARAMETER ==\n";

mb_internal_encoding('EUC-JP')  or print("mb_internal_encoding() failed\n");

print  mb_strpos($euc_jp, '���ܸ�', 0) . "\n";
print  mb_strpos($euc_jp, '0', 0) . "\n";
print  mb_strpos($euc_jp, 3, 0) . "\n";
print  mb_strpos($euc_jp, 0, 0) . "\n";

$r = mb_strpos($euc_jp, '�ڹ��', 0);
($r === FALSE) ? print "OK_STR\n"     : print "NG_STR\n";
$r = mb_strpos($euc_jp, "\n", 0);
($r === FALSE) ? print "OK_NEWLINE\n" : print "NG_NEWLINE\n";

// EUC-JP - No offset and encoding parameter
echo "== NO OFFSET AND ENCODING PARAMETER ==\n";

mb_internal_encoding('EUC-JP')  or print("mb_internal_encoding() failed\n");

print  mb_strpos($euc_jp, '���ܸ�') . "\n";
print  mb_strpos($euc_jp, '0') . "\n";
print  mb_strpos($euc_jp, 3) . "\n";
print  mb_strpos($euc_jp, 0) . "\n";

$r = mb_strpos($euc_jp, '�ڹ��');
($r === FALSE) ? print "OK_STR\n"     : print "NG_STR\n";
$r = mb_strpos($euc_jp, "\n");
($r === FALSE) ? print "OK_NEWLINE\n" : print "NG_NEWLINE\n";


// Invalid Parameters
echo "== INVALID PARAMETER TEST ==\n";

$r = mb_strpos($euc_jp,'','EUC-JP');
($r === NULL) ? print("OK_NULL\n") : print("NG_NULL\n");
$r = mb_strpos($euc_jp, $t_ary, 'EUC-JP');
($r === NULL) ? print("OK_ARRAY\n") : print("NG_ARRAY\n");
$r = mb_strpos($euc_jp, $t_obj, 'EUC-JP');
($r === NULL) ? print("OK_OBJECT\n") : print("NG_OBJECT\n");
$r = mb_strpos($euc_jp, $t_obj, 'BAD_ENCODING');
($r === NULL) ? print("OK_BAD_ENCODING\n") : print("NG_BAD_ENCODING\n");
?>
==DONE==
--EXPECT--
String len: 43
== POSITIVE OFFSET ==
10
0
3
0
34
30
33
30
== NEGATIVE OFFSET ==
34
30
33
30
0
== INVALID OFFSET ==
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
ERR: Warning
OK_INVALID_OFFSET
== OUT OF RANGE ==
OK_OUT_RANGE
OK_OUT_RANGE
OK_OUT_RANGE
OK_OUT_RANGE
OK_OUT_RANGE
OK_OUT_RANGE
OK_OUT_RANGE
OK_OUT_RANGE
== NON-EXISTENT ==
OK_STR
OK_NEWLINE
== NO ENCODING PARAMETER ==
10
0
3
0
OK_STR
OK_NEWLINE
== NO OFFSET AND ENCODING PARAMETER ==
10
0
3
0
OK_STR
OK_NEWLINE
== INVALID PARAMETER TEST ==
ERR: Warning
OK_NULL
ERR: Warning
OK_ARRAY
ERR: Warning
OK_OBJECT
ERR: Warning
OK_BAD_ENCODING
==DONE==