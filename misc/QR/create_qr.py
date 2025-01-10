import qrcode

# FLAGをQRコードに埋め込む
flag_data = "kitsec{di_rty_QR}"
qr = qrcode.QRCode(
    version=1,
    error_correction=qrcode.constants.ERROR_CORRECT_L,
    box_size=10,
    border=4,
)
qr.add_data(flag_data)
qr.make(fit=True)

# QRコードを画像として保存
img = qr.make_image(fill_color="black", back_color="white")
img.save("qr_flag.png")
