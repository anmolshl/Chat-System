<?php
    function MyDecrypt($input,$key){
        /* Open module, and create IV */
        $td = mcrypt_module_open('des', '', 'ecb', '');
        $key = substr($key, 0, mcrypt_enc_get_key_size($td));
        $iv_size = mcrypt_enc_get_iv_size($td);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        /* Initialize encryption handle */
        if (mcrypt_generic_init($td, $key, $iv) != -1) {
            /* 2 Reinitialize buffers for decryption */
            mcrypt_generic_init($td, $key, $iv);
            $p_t = mdecrypt_generic($td, $input);
            return $p_t;
            /* 3 Clean up */
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
        }
    } // end function Decrypt()


    function MyCrypt($input, $key){
        /* Open module, and create IV */
        $td = mcrypt_module_open('des', '', 'ecb', '');
        $key = substr($key, 0, mcrypt_enc_get_key_size($td));
        $iv_size = mcrypt_enc_get_iv_size($td);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        /* Initialize encryption handle */
        if (mcrypt_generic_init($td, $key, $iv) != -1) {
            /* 1 Encrypt data */
            $c_t = mcrypt_generic($td, $input);
            mcrypt_generic_deinit($td);
            return $c_t;
            /* 3 Clean up */
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
        }
    }

?>