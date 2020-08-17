# 命令行

### 什么是命令行

*命令提示符*是在操作系统中，提示进*行命令*输入的一种工作提示符。在Linux 中命令行指的其实就是Linux 命令，对于Linux系统来说，无论是中央处理器、内存、磁盘驱动器、键盘、鼠标，还是用户等都是文件，因此Linux命令也是一个文件，他可能是文本文件，也可能是二进制文件，或者其他文件。

比如`ls `命令，他其实就是一个可执行的文件，文件位于 `/bin/ls`,甚至于 `[`也是一个命令，也是一个文件，它的位置在 `/bin/[`

> 为什么linux 终端能能识别一些目录上的文件变成命令？

大体上有两个原因：

1. 环境变量

系统会从环境变量中的目录中查找命令是否存在，linux(mac)的 环境变量在 `$path`变量中,我们输出看一下:

```shell
$ echo $path
/usr/local/opt/python@3.8/bin /usr/local/opt/openssl/bin /usr/local/opt/node@10/bin /usr/local/opt/openldap/sbin /usr/local/opt/openldap/bin /usr/local/opt/curl-openssl/bin /usr/local/opt/openssl/bin /usr/local/opt/mysql-client/bin /usr/local/opt/apr/bin /usr/local/opt/icu4c/sbin /usr/local/opt/icu4c/bin /usr/local/opt/libpq/bin /Users/kingcheung/bin /Users/kingcheung/go/bin /usr/local/bin /Users/kingcheung/.composer/vendor/bin /Users/kingcheung/.cargo/bin /Users/kingcheung/.cargo/bin /usr/local/bin /usr/bin /bin /usr/sbin /sbin /usr/local/go/bin /Library/Apple/usr/bin /usr/local/opt/fzf/bin
```

上面的命令表示，当前登录用户下的环境变量是多少，可以 看到 /bin 在上面的环境变量中，所以我们的ls命令可以实别。理论上，我们自己写的程序只要放在上面环境变量的目录中，系统就能识别你的命令，当然，你也可以通过修改对应的配置文件把自己想要添加路径添加到环境变量（这个和windows上的环境变量大体是比较一致的）

2. 执行权限

系统能找到命令文件，并不代表就能执行，在linux系统中，还存在权限系统，分别读、写、执行三种。

当前用户无法命令的执行权限，同样无法执行命令。



> GUI这么好用，为什么还存在命令行？

首先，GUI开发复杂，还很难做到多平台通用，目前世面上多平台通用还流行的GUI没几个(electron 基于chorme内核算一个，QT算一个，但是开发都比较复杂)。其次，命令行开发简单，还很自由，容易扩展，牺牲的只是用户界面而已，但是对于开发人员来说，要不要用户界面其实没有多大所谓。

### 命令行规范（格式）

```shell
命令  [选项]  [参数]  
```

大部分命令行都是遵循这个格式的，选项和参数可以有也可以没有。如果有多个选项可以合并写，有多个参数并列写。

示例:

```shell
ls
ls -l
ls -lah
```

上面的 `-l`其实就是选项，带`-`开头的表示选项，不带`-`开头的表示参数,以`docker-composer` 命令为例:

```shell
docker-composer up -d --build
```

`docker-composer`为命令

`up`为参数

`-d`,`--build`都是选项

> 选项又分单字母选项和长选项,比如-d,以 - 开头的单字母。一般功能完善的命令行工具都会实现对应的单字母选项和长选项来指定同一 功能。其实在这个命令中，-d 对应的长选项就是--daemon

其实大部分linux命令都是符合这一语法规范的，当然除了一些个例。

另外一些规范：

-h或者--help 一般用于显示帮助文档

-V，-v或者--version 显示版本号

### 开发命令行

> 如何开发命令行？什么语言可能 开发命令行？

理论上所有的编程语言都可以开发命令行。linux 系统命令行绝大多数都是使用 C语言，python或者shell 语言开发的。（

**注意**：脚本语言开发的命令行需要解析器才能执行（这就是为什么几乎所有linux都内置了python解析器）

对于脚本语言而言，只要你的脚本能找到对应的解析器就能执行代码，一般解析器命令行工具都直接实现了对脚本文件的解析，例如:

```shell
python main.py
php test.php
node index.js
php composer.phar
```

#### 如何消除解析器指令，让命令更简短一些？

在脚本第一行添加解析器路径注释即可：

test.php

```php
#!/usr/bin/php

<?php declare(strict_types=1);
echo "test";
```

你就可以直接运行：

```shell
./test.php
```

#### 消除去除文件后缀

Linux 上一切皆文件，并不存在后缀名，也就是说，Linux上的文件的后缀只是约定成熟的写法，是写来给人看的，有没有都无所谓。因此把`test.php`改为`test`即可,运行变成了这样:

```shell
./test
```

#### 如何消除相对路径调用，让它看起来和系统命令一样

把命令文件丢到 `$path`目录里的目录即可。

> PHP包管理工具 composer 就是PHP语言实现的。







