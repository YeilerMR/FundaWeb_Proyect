<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo mensaje de contacto - Komercia</title>
</head>

<body
    style="margin:0;padding:40px 0;background-color:#f3f4f6;font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#1a1a1a;">

    <table role="presentation" align="center" width="600" cellpadding="0" cellspacing="0"
        style="background:#ffffff;border-radius:16px;box-shadow:0 6px 20px rgba(0,0,0,0.08);overflow:hidden;">

        <!-- HEADER -->
        <tr>
            <td align="center"
                style="background:linear-gradient(135deg,#ff6b35,#e85a28);padding:32px 20px;color:#ffffff;">
                <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="icon" width="56"
                    height="56" style="margin-bottom:12px;">
                <h1 style="margin:0;font-size:24px;font-weight:700;letter-spacing:0.3px;">Nuevo mensaje de contacto</h1>
            </td>
        </tr>

        <!-- BODY -->
        <tr>
            <td style="padding:36px 40px;">
                <p style="font-size:16px;color:#374151;margin-bottom:20px;">Has recibido un nuevo mensaje de contacto
                    desde
                    Komercia. A continuación se muestran los detalles del remitente:</p>

                <!-- Contact Info -->
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="background:#f9fafb;border-radius:12px;border:1px solid #e5e7eb;margin-bottom:28px;">
                    <tr>
                        <td style="padding:18px 24px;font-size:15px;line-height:1.7;color:#374151;">
                            <p style="margin:8px 0;"><strong>Comercio:</strong> {{ $data['commerce_name'] }}</p>
                            <p style="margin:8px 0;"><strong>Nombre:</strong> {{ $data['dsc_nombre'] }}</p>
                            <p style="margin:8px 0;"><strong>Teléfono:</strong> {{ $data['dsc_telefono'] }}</p>
                            <p style="margin:8px 0;"><strong>Correo:</strong>
                                <a href="mailto:{{ $data['dsc_correo'] }}"
                                    style="color:#ff6b35;text-decoration:none;font-weight:500;">{{ $data['dsc_correo'] }}</a>
                            </p>
                        </td>
                    </tr>
                </table>

                <!-- Message -->
                <h2 style="color:#004e89;font-size:18px;margin-bottom:12px;">Mensaje del interesado</h2>
                <div
                    style="background:#fff8f5;border:1px solid #ffd9c2;border-radius:10px;padding:18px 22px;font-size:15px;line-height:1.6;color:#333;">
                    {{ $data['dsc_mensaje'] }}
                </div>

                <!-- CTA -->
                <div style="text-align:center;margin-top:36px;">
                    <a href="mailto:{{ $data['dsc_correo'] }}"
                        style="background-color:#ff6b35;color:#ffffff;text-decoration:none;padding:12px 28px;border-radius:8px;font-size:15px;font-weight:600;display:inline-block;box-shadow:0 4px 10px rgba(255,107,53,0.3);">
                        Responder al contacto
                    </a>
                </div>
            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
            <td align="center"
                style="background:#f9fafb;padding:22px;border-top:1px solid #e5e7eb;font-size:13px;color:#9ca3af;">
                Enviado desde <a href="https://komercia.com"
                    style="color:#ff6b35;text-decoration:none;font-weight:600;">Komercia</a><br>
                <span style="font-size:12px;">Conectando negocios locales contigo</span>
            </td>
        </tr>
    </table>

</body>

</html>
