const generatePayload = require('promptpay-qr'); 
const qrcode = require('qrcode'); 

const mobileNumber = process.argv[2];
const amount = parseFloat(process.argv[3]);

const payload = generatePayload(mobileNumber, { amount });

const options = { type: 'svg', color: { dark: '#000', light: '#fff' } };

qrcode.toString(payload, options, (err, svg) => {
    if (err) return console.error(err);
    console.log(svg);
});
