<?php

class MailTemplates {

    public static function retrieveMailTemplate($mailTemplate)
    {
        if ($mailTemplate === 1) {
            $template = '<table style="border-collapse:collapse;margin:0;padding:0;background-color:#ececec;min-height:100%!important;width:100%!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td align="center">
                <table style="border-collapse:collapse;text-align:left;max-width:600px" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="center" style="padding:20px;font-family:Arial,helvetica,sans-serif;color:#666666;font-size:11px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table style="border-collapse:collapse;text-align:left;border-radius:5px 5px 0 0;background-color:#ffffff;min-width:330px;max-width:100%;padding:20px;" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td align="left" valign="top">
                                                <table bgcolor="#FAFAFA" width="100%" style="border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#ececec;border-radius:5px 5px 0 0" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="41" valign="middle" style="padding-left:20px;padding-top:10px;padding-bottom:10px">
                                                                <a href="" target="_blank">
                                                                    <img src="https://raw.githubusercontent.com/OLX-Hackathon-2015/masaze/master/web/images/logo.png" alt="OLX" width="200" height="65" border="0" style="display:block;margin-right:10px" />
                                                                </a>
                                                            </td>
                                                            <td valign="middle">
                                                                <a href="" style="text-decoration:none;color:#000000!important;font-size:18px;font-family:Arial,helvetica,sans-serif" target="_blank"><strong></strong></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:660px;height:400px;padding:20px;" align="center" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr style="display:block;padding-bottom:25px;text-align:left;font-family:Arial,helvetica,sans-serif;">
                                                            <td>
                                                                <p style="padding-top:20px"><<USERNAME>>:</p>
                                                                <P>Te invitamos a disfrutar de una pausa revitalizadora...</p>
                                                                <h3 style="font-size:32px;margin:15px 0px;text-align:center">MASSAGE AT WORK</h3>
                                                                <p>Está comprobado que una rutina de masajes alivia las tensiones del cuerpo y revitaliza nuestra energía creando una sensación de gran bienestar.</p>
                                                                <p style="padding-top:20px;text-align:center">Podes disfrutar de sesiones de masajes en las oficinas de OLX,</p>
                                                                <p style="text-align:center;font-weight:bold">
                                                                    Martes 14:15 a 18 hrs.</p>
                                                                <p style="text-align:center;font-weight:bold">
                                                                    Viernes de 14:30 a 17:30 hrs.</p>
                                                                <p style="padding-top:20px">“Quick Massage”, es un masaje descontracturante que cubre las áreas del cuello, espalda, hombros, brazos, manos y cabeza.</p>
                                                                <p>El mismo es realizado por un profesional altamente calificado en una silla especialmente diseñada y tiene una duración de 15’.</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center;padding:30px;">
                                                                <a href="http://10.4.12.27:9876/massage_landing_1.php?w=<<EMAILTO>>" style="display:inline-block;color:#ffffff;padding-top:12px;padding-bottom:12px;padding-left:20px;padding-right:20px;background-color:#29aae1;text-decoration:none;border-radius:5px;font-family:Arial,helvetica,sans-serif;font-size:16px;font-weight:bold;text-align:center;vertical-align:top;margin-right:10px;border-bottom:3px solid #057ea8" target="_blank">Reservalo ahora</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="margin-top:20px;background-color:#d5eaef;padding:10px;font-weight:bold;text-align:left;font-family:Arial,helvetica,sans-serif;">
                                                                <p>A TENER EN CUENTA:</p>
                                                                <ul style="list-style-position:initial;padding-left:25px">
                                                                    <li style="margin-bottom:10px">
                                                                        Se abonará un co-pago de $5 -con cambio, sin excepción- que se entregará directamente al masajista.</li>
                                                                    <li>Para solicitar tu reserva click en "Reservalo Ahora"</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="http://design.olx.com/public/HR/images/img-mass.jpg" alt="foto1" style="margin-top:20px" class="CToWUd"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p style="font-size:22px;font-weight:bold;margin-bottom:20px;font-family:Arial,helvetica,sans-serif;">OLX desea que lo disfrutes.... ¡No e lo pierdas!</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';
        } else if ($mailTemplate === 2)  {
            $template = '<table style="border-collapse:collapse;margin:0;padding:0;background-color:#ececec;min-height:100%!important;width:100%!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td align="center">
                <table style="border-collapse:collapse;text-align:left;max-width:600px" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <table style="border-collapse:collapse;text-align:left;border-radius:5px 5px 0 0;background-color:#ffffff;min-width:330px;max-width:100%" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td align="left" valign="top">
                                                <table bgcolor="#FAFAFA" width="100%" style="border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#ececec;border-radius:5px 5px 0 0" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="41" valign="middle" style="padding-left:20px;padding-top:10px;padding-bottom:10px">
                                                                <a href="" target="_blank">
                                                                    <img src="https://raw.githubusercontent.com/OLX-Hackathon-2015/masaze/master/web/images/logo.png" alt="OLX" width="200" height="65" border="0" style="display:block;margin-right:10px" />
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" width="100%" style="padding-top:0;padding-bottom:0;padding-right:20px;padding-left:20px">
                                                <table width="100%" style="border-collapse:collapse;text-align:left" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top" style="width:100%">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" style="padding-top:22px;padding-bottom:22px;font-size:31px;font-family:Arial,helvetica,sans-serif">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" style="padding-bottom:30px;font-size:13px;line-height:1.3;font-family:Arial,helvetica,sans-serif">
                ¡Hola <<USERNAME>>!
                                                                                <br>
                                                                                
                    <h1>Tenemos una buena noticia para vos:<br/><br/>¡Hoy tenés una pausa revitalizadora!</h1>
                    <br/><br/>  

                                                                                </p>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="background-color:#fafafa;padding:22px;font-size:31px;font-family:Arial,helvetica,sans-serif">
                Tu horario es <<APPOINTMENT>> hs.
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="height:10px"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table width="100%" style="border-collapse:collapse;text-align:left" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="center" align="center" style="width:100%%;padding-top:10px;padding-bottom:10px;">

                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="height:10px"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="padding-bottom:20px;font-family:Arial,helvetica,sans-serif;color:#000000;font-size:13px">
                <p>Por favor recordá llegar a horario y traer un co-pago de $5.</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';
        } else {
            $template = '<table style="border-collapse:collapse;margin:0;padding:0;background-color:#ececec;min-height:100%!important;width:100%!important" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td align="center">
                <table style="border-collapse:collapse;text-align:left;max-width:600px" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <table style="border-collapse:collapse;text-align:left;border-radius:5px 5px 0 0;background-color:#ffffff;min-width:330px;max-width:100%" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td align="left" valign="top">
                                                <table bgcolor="#FAFAFA" width="100%" style="border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#ececec;border-radius:5px 5px 0 0" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="41" valign="middle" style="padding-left:20px;padding-top:10px;padding-bottom:10px">
                                                                <a href="" target="_blank">
                                                                    <img src="https://raw.githubusercontent.com/OLX-Hackathon-2015/masaze/master/web/images/logo.png" alt="OLX" width="200" height="65" border="0" style="display:block;margin-right:10px" />
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" width="100%" style="padding-top:0;padding-bottom:0;padding-right:20px;padding-left:20px">
                                                <table width="100%" style="border-collapse:collapse;text-align:left" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top" style="width:100%">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" style="padding-top:22px;padding-bottom:22px;font-size:31px;font-family:Arial,helvetica,sans-serif">
                Lo sentimos
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" style="padding-bottom:30px;font-size:13px;line-height:1.3;font-family:Arial,helvetica,sans-serif">
                                                                                <p>
            Por hoy no tenemos más turnos disponibles. Pero no te preocues ¡La próxima vez vas a tener más chances!
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="height:10px"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table width="100%" style="border-collapse:collapse;text-align:left" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="center" align="center" style="width:100%%;padding-top:10px;padding-bottom:10px;">

                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="height:10px"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="padding-bottom:20px;font-family:Arial,helvetica,sans-serif;color:#000000;font-size:13px">
                Gracias por usar masaże.
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';
        }

        return $template;
    }
}
