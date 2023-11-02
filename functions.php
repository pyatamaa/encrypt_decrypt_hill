<?php
function hill_cipher($text, $key, $mode)
{
    $mod = 26;
    $text = str_replace(" ", "", strtoupper($text));
    $text_len = strlen($text);

    if ($text_len % 2 != 0) {
        $text .= "X";
    }

    $result = "";
    if ($mode === "encrypt") {
        for ($i = 0; $i < $text_len; $i += 2) {
            $char_pair = [ord($text[$i]) - ord('A'), ord($text[$i + 1]) - ord('A')];
            $encrypted_pair = matrix_modulo([
                [
                    ($key[0][0] * $char_pair[0] + $key[0][1] * $char_pair[1]) % $mod
                ],
                [
                    ($key[1][0] * $char_pair[0] + $key[1][1] * $char_pair[1]) % $mod
                ]
            ], $mod);

            $result .= chr($encrypted_pair[0][0] + ord('A')) . chr($encrypted_pair[1][0] + ord('A'));
        }
    } else if ($mode === "decrypt") {
        $key_inverse = matrix_inverse($key, $mod);
        for ($i = 0; $i < $text_len; $i += 2) {
            $char_pair = [ord($text[$i]) - ord('A'), ord($text[$i + 1]) - ord('A')];
            $decrypted_pair = matrix_modulo([
                [
                    ($key_inverse[0][0] * $char_pair[0] + $key_inverse[0][1] * $char_pair[1]) % $mod
                ],
                [
                    ($key_inverse[1][0] * $char_pair[0] + $key_inverse[1][1] * $char_pair[1]) % $mod
                ]
            ], $mod);

            $result .= chr($decrypted_pair[0][0] + ord('A')) . chr($decrypted_pair[1][0] + ord('A'));
        }
    }

    return $result;
}

function determinant($matrix)
{
    return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
}

function matrix_multiply($matrix, $scalar)
{
    for ($i = 0; $i < count($matrix); $i++) {
        for ($j = 0; $j < count($matrix[0]); $j++) {
            $matrix[$i][$j] *= $scalar;
        }
    }
    return $matrix;
}

function matrix_modulo($matrix, $mod)
{
    for ($i = 0; $i < count($matrix); $i++) {
        for ($j = 0; $j < count($matrix[0]); $j++) {
            $matrix[$i][$j] = ($matrix[$i][$j] % $mod + $mod) % $mod;
        }
    }
    return $matrix;
}

function matrix_inverse($matrix, $mod)
{
    $det = determinant($matrix);
    $det = ($det % $mod + $mod) % $mod; // Ensure positive determinant
    $inv_det = null;

    for ($i = 1; $i < $mod; $i++) {
        if (($det * $i) % $mod == 1) {
            $inv_det = $i;
            break;
        }
    }

    if ($inv_det === null) {
        throw new Exception("Modular inverse does not exist.");
    }

    $adj_matrix = matrix_modulo([
        [$matrix[1][1], -$matrix[0][1]],
        [-$matrix[1][0], $matrix[0][0]]
    ], $mod);

    $inverse_matrix = matrix_modulo(matrix_multiply($adj_matrix, $inv_det), $mod);
    return $inverse_matrix;
}
