<?php

require_once 'utils.php'; // 👉 改成你的 utils 檔案實際路徑

$params = [
    'a' => '2222',
    'c' => '111',
    'd' => 20,
    'm' => 100,
    'n' => '1',
    'l' => null // will be removed
];

// Generate base string
echo "✅ Base String:\n";
$baseString = getBaseString($params);
echo $baseString . PHP_EOL;

// MD5 and HMAC checks
echo "🔐 MD5: " . md5($baseString) . PHP_EOL;
echo "🔐 HMAC SHA256: " . hmacSha256($baseString, 'xxxxxxxxxxxxxxxx') . PHP_EOL;

// Generate RSA key pair
echo "\n🔑 Generating RSA Key Pair...\n";
$keys = genKey();
$privKey = $keys['privKey'];
$pubKey = $keys['pubKey'];

echo "🔐 Private Key:\n$privKey\n";
echo "🔐 Public Key:\n$pubKey\n";

// Sign the base string
echo "\n✍️ Signing...\n";
$signature = getRSASign($baseString, $privKey);
echo "🖋️ Signature:\n$signature\n";

// Verify - correct content
echo "\n🔍 Verify Signature (Correct Content):\n";
$result = verifyRSASign($baseString, $signature, $pubKey);
echo "✔️ Signature valid? " . ($result ? '✅ YES' : '❌ NO') . PHP_EOL;

// Verify - wrong content
echo "\n🔍 Verify Signature (Wrong Content):\n";
$wrongResult = verifyRSASign($baseString . "BROKEN", $signature, $pubKey);
echo "✔️ Signature valid? " . ($wrongResult ? '❌ Oops' : '✅ NO') . PHP_EOL;

// Verify - tampered signature
echo "\n🔍 Verify Signature (Tampered Signature):\n";
$corrupted = base64_decode($signature);
$corrupted[5] = ~$corrupted[5]; // Flip byte
$badSign = base64_encode($corrupted);
$tamperedResult = verifyRSASign($baseString, $badSign, $pubKey);
echo "✔️ Signature valid? " . ($tamperedResult ? '❌ Oops' : '✅ NO') . PHP_EOL;