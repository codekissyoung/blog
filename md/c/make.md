# GNU Make 项目管理

## 默认规则 default rule

- 格式
    ```makefile
    target:prerequisite1 prerequisite2
        commands
    ```
    ```makefile
    目标文件:依赖文件1 依赖文件2
        生成目标文件的命令
    ```
- 例子
    ```makefile
    foo.o:foo.c foo.h
        gcc -c foo.c
    ```
    ```makefile
    count_words:count_words.o lexer.o -lfl
        gcc count_words.o lexer.o -lfl -o count_words
    ```
  - 对于必要条件里的 `-lfl`, make 对这个语法提供了支持, `-l<NAME>` 形式指示make去检查系统库里面`libNAME.so` 或者是`libNAME.a`是否存在