# ELF 各个Section(段)
- .text 代码段，存放各种指令
- .data 数据段，存放已经初始化了的全局变量和静态局部变量
- .bss 段，存放未初始化的全局变量和静态局部变量


# SimpleSection.c
```c
// gcc -c  SimpleSection.c -o SimpleSection.o
int printf( const char* format, ... );
int global_init_var = 84;
int global_init_uninit_var;

void func1( int i )
{
    printf("%d\n", i );
}

int main( void )
{
    static int static_var = 85;
    static int static_var2;
    int a = 1;
    int b;
    func1( static_var + static_var2 + a + b );

    return a;
}
```
# objdump -x 打印 ELF 文件的基本段信息
```bash
➜  compile git:(master) ✗ objdump -x SimpleSection.o

SimpleSection.o：     文件格式 elf64-x86-64
SimpleSection.o
体系结构：i386:x86-64， 标志 0x00000011：
HAS_RELOC, HAS_SYMS
起始地址 0x0000000000000000

节：
Idx Name          Size      VMA               LMA               File off  Algn
  0 .text         00000055  0000000000000000  0000000000000000  00000040  2**0
                  CONTENTS, ALLOC, LOAD, RELOC, READONLY, CODE
  1 .data         00000008  0000000000000000  0000000000000000  00000098  2**2
                  CONTENTS, ALLOC, LOAD, DATA
  2 .bss          00000004  0000000000000000  0000000000000000  000000a0  2**2
                  ALLOC
  3 .rodata       00000004  0000000000000000  0000000000000000  000000a0  2**0
                  CONTENTS, ALLOC, LOAD, READONLY, DATA
  4 .comment      00000035  0000000000000000  0000000000000000  000000a4  2**0
                  CONTENTS, READONLY
  5 .note.GNU-stack 00000000  0000000000000000  0000000000000000  000000d9  2**0
                  CONTENTS, READONLY
  6 .eh_frame     00000058  0000000000000000  0000000000000000  000000e0  2**3
                  CONTENTS, ALLOC, LOAD, RELOC, READONLY, DATA
SYMBOL TABLE:
0000000000000000 l    df *ABS*	0000000000000000 SimpleSection.c
0000000000000000 l    d  .text	0000000000000000 .text
0000000000000000 l    d  .data	0000000000000000 .data
0000000000000000 l    d  .bss	0000000000000000 .bss
0000000000000000 l    d  .rodata	0000000000000000 .rodata
0000000000000004 l     O .data	0000000000000004 static_var.1840
0000000000000000 l     O .bss	0000000000000004 static_var2.1841
0000000000000000 l    d  .note.GNU-stack	0000000000000000 .note.GNU-stack
0000000000000000 l    d  .eh_frame	0000000000000000 .eh_frame
0000000000000000 l    d  .comment	0000000000000000 .comment
0000000000000000 g     O .data	0000000000000004 global_init_var
0000000000000004       O *COM*	0000000000000004 global_init_uninit_var
0000000000000000 g     F .text	0000000000000022 func1
0000000000000000         *UND*	0000000000000000 printf
0000000000000022 g     F .text	0000000000000033 main


RELOCATION RECORDS FOR [.text]:
OFFSET           TYPE              VALUE
0000000000000011 R_X86_64_32       .rodata
000000000000001b R_X86_64_PC32     printf-0x0000000000000004
0000000000000033 R_X86_64_PC32     .data
0000000000000039 R_X86_64_PC32     .bss-0x0000000000000004
000000000000004c R_X86_64_PC32     func1-0x0000000000000004


RELOCATION RECORDS FOR [.eh_frame]:
OFFSET           TYPE              VALUE
0000000000000020 R_X86_64_PC32     .text
0000000000000040 R_X86_64_PC32     .text+0x0000000000000022
```

#  objdump -sd 16进制打印并且将包含指令的段反汇编
```bash
➜  compile git:(master) ✗ objdump -sd SimpleSection.o

SimpleSection.o：     文件格式 elf64-x86-64

Contents of section .text:
 0000 554889e5 4883ec10 897dfc8b 45fc89c6  UH..H....}..E...
 0010 bf000000 00b80000 0000e800 00000090  ................
 0020 c9c35548 89e54883 ec10c745 f8010000  ..UH..H....E....
 0030 008b1500 0000008b 05000000 0001c28b  ................
 0040 45f801c2 8b45fc01 d089c7e8 00000000  E....E..........
 0050 8b45f8c9 c3                          .E...           
Contents of section .data:
 0000 54000000 55000000                    T...U...        
Contents of section .rodata:
 0000 25640a00                             %d..            
Contents of section .comment:
 0000 00474343 3a202855 62756e74 7520352e  .GCC: (Ubuntu 5.
 0010 342e302d 36756275 6e747531 7e31362e  4.0-6ubuntu1~16.
 0020 30342e35 2920352e 342e3020 32303136  04.5) 5.4.0 2016
 0030 30363039 00                          0609.           
Contents of section .eh_frame:
 0000 14000000 00000000 017a5200 01781001  .........zR..x..
 0010 1b0c0708 90010000 1c000000 1c000000  ................
 0020 00000000 22000000 00410e10 8602430d  ...."....A....C.
 0030 065d0c07 08000000 1c000000 3c000000  .]..........<...
 0040 00000000 33000000 00410e10 8602430d  ....3....A....C.
 0050 066e0c07 08000000                    .n......        

Disassembly of section .text:

0000000000000000 <func1>:
   0:	55                   	push   %rbp
   1:	48 89 e5             	mov    %rsp,%rbp
   4:	48 83 ec 10          	sub    $0x10,%rsp
   8:	89 7d fc             	mov    %edi,-0x4(%rbp)
   b:	8b 45 fc             	mov    -0x4(%rbp),%eax
   e:	89 c6                	mov    %eax,%esi
  10:	bf 00 00 00 00       	mov    $0x0,%edi
  15:	b8 00 00 00 00       	mov    $0x0,%eax
  1a:	e8 00 00 00 00       	callq  1f <func1+0x1f>
  1f:	90                   	nop
  20:	c9                   	leaveq
  21:	c3                   	retq   

0000000000000022 <main>:
  22:	55                   	push   %rbp
  23:	48 89 e5             	mov    %rsp,%rbp
  26:	48 83 ec 10          	sub    $0x10,%rsp
  2a:	c7 45 f8 01 00 00 00 	movl   $0x1,-0x8(%rbp)
  31:	8b 15 00 00 00 00    	mov    0x0(%rip),%edx        # 37 <main+0x15>
  37:	8b 05 00 00 00 00    	mov    0x0(%rip),%eax        # 3d <main+0x1b>
  3d:	01 c2                	add    %eax,%edx
  3f:	8b 45 f8             	mov    -0x8(%rbp),%eax
  42:	01 c2                	add    %eax,%edx
  44:	8b 45 fc             	mov    -0x4(%rbp),%eax
  47:	01 d0                	add    %edx,%eax
  49:	89 c7                	mov    %eax,%edi
  4b:	e8 00 00 00 00       	callq  50 <main+0x2e>
  50:	8b 45 f8             	mov    -0x8(%rbp),%eax
  53:	c9                   	leaveq
  54:	c3                   	retq   
```

# size 查看代码段 数据段 和 BSS段 的长度
```bash
➜  compile git:(master) size SimpleSection.o
   text	   data	    bss	    dec	    hex	filename
    177	      8	      4	    189	     bd	SimpleSection.o
```
