# tos_info
Information about decimal type of service number introduced class


Usage:

```

$tos = '184';
print_r(Network::tos_info($tos));

Array
(
    [ToS] => Array
        (
            [Decimal] => 184
            [Hexadecimal] => 0xB8
            [Binary] => 10111000
            [Precedence] => Array
                (
                    [Decimal] => 5
                    [Binary] => 101
                    [Name] => Critical - Mainly used for Voice RTP
                )

            [Flags] => Array
                (
                    [Delay] => 1
                    [Throughput] => 1
                    [Reliability] => 0
                )

            [ECN] => Array
                (
                    [Binary] => 00
                    [Value] => Non-ECT
                    [Description] => Non ECN-Capable Transport
                )

        )

    [DSCP] => Array
        (
            [Binary] => 101110
            [Hexadecimal] => 0x2E
            [Decimal] => 46
            [Class] => ef
        )

)
```
