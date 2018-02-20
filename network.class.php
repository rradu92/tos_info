<?php

class Network{

    function tos_info($tos){
        $ps = []; $pr = []; $es = []; $ed = []; $cs = []; $cc = [];
 
        $es[] = '/00/'; $er[] = 'Non-ECT';  $ed[] = 'Non ECN-Capable Transport';
        $es[] = '/10/'; $er[] = 'ECT(0)';   $ed[] = 'ECN Capable Transport';
        $es[] = '/01/'; $er[] = 'ECT(1)';   $ed[] = 'ECN Capable Transport';
        $es[] = '/11/'; $er[] = 'CE';       $ed[] = 'Congestion Encountered';
 
        $ps[] = '/000/'; $pr[] = 'Routine (Best Effort)';
        $ps[] = '/001/'; $pr[] = 'Priority';
        $ps[] = '/010/'; $pr[] = 'Immediate';
        $ps[] = '/011/'; $pr[] = 'Flash - Mainly used for Voice Signaling or Video';
        $ps[] = '/100/'; $pr[] = 'Flash Override';
        $ps[] = '/101/'; $pr[] = 'Critical - Mainly used for Voice RTP';
        $ps[] = '/110/'; $pr[] = 'Internet (Internetwork Control)';
        $ps[] = '/111/'; $pr[] = 'Network (Network Control)';
 
        $cs[] = '/00000000/'; $cc[] = 'none';
        $cs[] = '/00000100/'; $cc[] = 'none';
        $cs[] = '/00001000/'; $cc[] = 'none';
        $cs[] = '/00001100/'; $cc[] = 'none';
        $cs[] = '/00010000/'; $cc[] = 'none';
        $cs[] = '/00100000/'; $cc[] = 'cs1';
        $cs[] = '/00101000/'; $cc[] = 'af11';
        $cs[] = '/00110000/'; $cc[] = 'af12';
        $cs[] = '/00111000/'; $cc[] = 'af13';
        $cs[] = '/01000000/'; $cc[] = 'cs2';
        $cs[] = '/01001000/'; $cc[] = 'af21';
        $cs[] = '/01010000/'; $cc[] = 'af22';
        $cs[] = '/01011000/'; $cc[] = 'af23';
        $cs[] = '/01100000/'; $cc[] = 'cs3';
        $cs[] = '/01101000/'; $cc[] = 'af31';
        $cs[] = '/01110000/'; $cc[] = 'af32';
        $cs[] = '/01111000/'; $cc[] = 'af33';
        $cs[] = '/10000000/'; $cc[] = 'cs4';
        $cs[] = '/10001000/'; $cc[] = 'af41';
        $cs[] = '/10010000/'; $cc[] = 'af42';
        $cs[] = '/10011000/'; $cc[] = 'af43';
        $cs[] = '/10100000/'; $cc[] = 'cs5';
        $cs[] = '/10110000/'; $cc[] = 'voice-admin';
        $cs[] = '/10111000/'; $cc[] = 'ef';
        $cs[] = '/11000000/'; $cc[] = 'cs6';
        $cs[] = '/11100000/'; $cc[] = 'cs7';
 
 
        $array              = [];
 
        $tos_dec            = $tos;
        $tos_bin            = sprintf("%08d", decbin($tos));
        $tos_hex            = "0x".strtoupper(str_pad(dechex(bindec($tos_bin)), 2, 0, STR_PAD_LEFT));
        $tos_array          = str_split($tos_bin);
 
        $tos_precedence_bin = substr($tos_bin, 0, 3);
        $tos_precedence_dec = bindec($tos_precedence_bin);
        $tos_precedence_str = preg_replace($ps, $pr, $tos_precedence_bin);
 
        $tos_dtr_bin        = str_split(substr($tos_bin, 3, 3));
        $dscp_bin           = substr($tos_bin, 0, 6);
        $dscp_dec           = bindec($dscp_bin);
        $dscp_hex           = "0x".strtoupper(str_pad(dechex(bindec($dscp_bin)), 2, 0, STR_PAD_LEFT));
        $dscp_class         = preg_replace($cs, $cc, $tos_bin);
        $dscp_class         = (is_numeric($dscp_class)) ? 'unknown' : $dscp_class;
 
        $ecn_bin            = implode('', array_slice($tos_array, 6, 8));
        $ecn_val            = preg_replace($es, $er, $ecn_bin);
        $ecn_des            = preg_replace($es, $ed, $ecn_bin);
 
        $array['ToS']['Decimal']                    = $tos_dec;
        $array['ToS']['Hexadecimal']                = $tos_hex;
        $array['ToS']['Binary']                     = $tos_bin;
 
        $array['ToS']['Precedence']['Decimal']      = $tos_precedence_dec;
        $array['ToS']['Precedence']['Binary']       = $tos_precedence_bin;
        $array['ToS']['Precedence']['Name']         = $tos_precedence_str;
 
        $array['ToS']['Flags']['Delay']             = $tos_dtr_bin['0'];
        $array['ToS']['Flags']['Throughput']        = $tos_dtr_bin['1'];
        $array['ToS']['Flags']['Reliability']       = $tos_dtr_bin['2'];
 
        $array['ToS']['ECN']['Binary']              = $ecn_bin;
        $array['ToS']['ECN']['Value']               = $ecn_val;
        $array['ToS']['ECN']['Description']         = $ecn_des;
 
        $array['DSCP']['Binary']                    = $dscp_bin;
        $array['DSCP']['Hexadecimal']               = $dscp_hex;
        $array['DSCP']['Decimal']                   = $dscp_dec;
        $array['DSCP']['Class']                     = $dscp_class;
 
        return $array;
    }
}
