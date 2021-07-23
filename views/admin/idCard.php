<?php

use core\middlewares\Url; ?>
<table width="920" border="0" align="center">
    <tbody><tr>
        <td>&nbsp;</td>
        <td height="229"><table width="846" height="262" border="0" align="center" cellpadding="2" cellspacing="2" background="<?= Url::home("/assets/backend/assets/img/idcardbg.png")?>" style="background-repeat:no-repeat">
                <tbody><tr>
                    <td width="311" height="69" style="font-family:Arial Black, Gadget, sans-serif">&nbsp;</td>
                    <td width="104" rowspan="3" valign="top"><img src="<?=Url::home("/$user->photo")?>" height="100" width="100"></td>
                    <td width="22">&nbsp;</td>
                    <td width="383" align="center"><font size="5" style="font-family:Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif">FEDERAL UNIVERSITY OF TECHNOLOGY OWERRI</font></td>
                </tr>
                <tr>
                    <td height="43" align="center" valign="middle" style="font-family:Arial Black, Gadget, sans-serif">
                        <font color="#c4c2c2"><?=$user->fname?> <?=$user->mname?> <?=$user->lname?></font>
                    </td>
                    <td>&nbsp;</td>

                    <td style="font-size:13px">
                        <p>
                            This is  to certify that the person whose passport photograph appear on this Access Card is a student of FUTO. This card is a property of FUTO. If found, please return to the nearest security unit.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td height="27" style="font-family:Arial Black, Gadget, sans-serif;color:#ffffff">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="68" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td width="122" height="42" valign="bottom"><span style="font-family:Arial Black, Gadget, sans-serif;color:#c4c2c2">&nbsp; Mat. No</span></td>
                                <td width="93">&nbsp;</td>
                                <td width="121" align="right" valign="bottom" style="font-family:Arial Black, Gadget, sans-serif;color:#ffffff">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left" valign="bottom" style="font-family:Arial Black, Gadget, sans-serif;color:#000000;">&nbsp;<?=$user->reg_no?></td>
                                <td>&nbsp;</td>
                                <td align="right">&nbsp;</td>
                            </tr>
                            </tbody></table>
                    </td>
                    <td>&nbsp;</td>
                    <td align="center" valign="center">
                        <img src="<?=Url::home("/assets/uploads/qrcode/PSC1104165.png")?>" height="80" width="80">

                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>
