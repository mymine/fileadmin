<?php
##感谢老虎会游戏提供代码
   /*取得文件或目录的访问路径（目录总是包含结尾的/）*/
    function getFileUrl($path)
    {
        $realPath = realpath($path);

        if (false === $realPath) {
            throw new Exception("文件 '$path' 不存在！");
        }

        $webRoot = realpath($_SERVER['DOCUMENT_ROOT']);

        if (false === $webRoot) {
            throw new Exception("无法获取 \$_SERVER['DOCUMENT_ROOT'] 的绝对路径！");
        }

        if (0 !== strpos($realPath, $webRoot)) {
            throw new Exception("文件 '$path' 位于Web根目录外！");
        }

        $url = substr($realPath, strlen($webRoot));
        $url = strtr($url, '\\', '/');

        if (is_dir($realPath)) {
            $url .= '/';
        }

        return $url;
    }
?>
