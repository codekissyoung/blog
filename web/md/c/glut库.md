opengl 的核心（gl库，glu库）不提供跟操作系统交互（创建窗口，处理事件）的函数。opengl专注于渲染。在开发环境，交互是由wgl库（windows），glx库（linux），Cocoa库（Mac）负责的。但是我们学习一般使用跨平台库glut。以下是glut给我们提供的函数。

**初始化和创建窗口**
```
void glutInit(int argc,int **argv);//初始化
```
```
void glutInitDisplayMode(unsigned int mode);//选择渲染模式
mode：
GLUT_RGBA,GLUT_DOUBLE,GLUT_SINGLE,GLUT_DEPTH 
使用 “ | ” 组合这些模式！
```
```
void glutInitWindowSize(int w, int y);//窗口大小
void glutInitWindowPosition(int x ,int y);//窗口位置
void glutCreateWindow(char *name);//创建窗口
```

**处理窗口和输入事件**
```
void glutDisplayFunc(void (*func)(void));
/*注册处理窗口重绘事件的回调函数，窗口重绘：窗口刚打开、弹出、内容遭到破坏，显式调用了glutPostRedisplay()函数 */
```
```
void glutReshapeFunc(void (*func)(int width,int height));
/*注册窗口大小发生改变时的回调函数，回调函数的width ，height是新窗口的宽和高，一般会在里面调用glViewport(0,0,width,height);使得视口随窗口大小改变*/
```
```
void glutKeyBoardFunc(void (*func)(unsigned char key,int x,int y));
/*注册处理键盘输入的回调函数，key是按下的键，x，y是鼠标正处于窗口内的坐标*/
```
```
void glutMouseFunc(void (*func)(int button,int state,int x,int y));
/*注册处理鼠标按下的回掉函数，button是左键，中间滚轮，右键，state 是表示键按下或者释放的状态，x，y同上*/
```
```
void glutMotionFunc(void (*func)(int x,int y));
/*注册鼠标移动时的回调函数，x，y同上*/
```
```
void glutIdleFunc(void (*func)(void));
/*注册处理除了上述事件的其他任何事件的回调函数*/
```
```
void glutMainLoop(void);//进入事件循环
```

