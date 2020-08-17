# json与yaml格式转换小工具

 ```
$ conv

转换数据格式小工具

Usage:
  conv [flags]
  conv [command]

Available Commands:
  help        Help about any command
  json        转json
  yaml        转yaml

Flags:
  -h, --help              help for conv
  -I, --in-file string    待转换的文件地址
  -O, --out-file string   转换后的文件地址
```
### json,yaml 互转 
```
#输出yaml内容
conv yaml -I a.json

#输出到文件
conv yaml -I a.json -O b.yaml 
conv yaml --in-file=a.json --out-file=b.yaml

# 通过重定义传入
conv yaml < a.json

# 通过管道传入
cat a.json | conv yaml 

# yaml 转 json
conv json -I a.yaml -O b.json
```
