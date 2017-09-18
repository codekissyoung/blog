```

#include <GL/glut.h>
 
void myDisplay(void)
 
{
 
     glClear(GL_COLOR_BUFFER_BIT);
 
     glRectf(-0.5f, -0.5f, 0.5f, 0.5f);
 
     glFlush();
 
}
 
int main(int argc, char *argv[])
 
{
 
     glutInit(&argc, argv); //对GLUT进行初始化
 
     glutInitDisplayMode(GLUT_RGB | GLUT_SINGLE);
 
     glutInitWindowPosition(100, 100); //windows 窗口位置
 
     glutInitWindowSize(400, 400);  // windwos 窗口大小
 
     glutCreateWindow("第一个OpenGL程序"); // windows 窗口标题
 
     glutDisplayFunc(myDisplay); // 执行 myDisplay 回调函数，绘制图形
 
     glutMainLoop(); /*它能处理操作系统中特定的消息及击键等事件操作，直到我们的程序结束*/
 
     return 0;
 
}
```

﻿
glEnable(GL_LINE_STIPPLE)
启动虚线模式
glDisable(GL_LINE_STIPPLE)
关闭虚线模式
glLineStipple(GLint factor, GLushort pattern) 设置虚线样式
pattern是由1和0组成的长度为16的序列，从最低位开始看，如果为1，则直线上接下来应该画的factor个点将被画为实的；如果为0，则直线上接下来应该画的factor个点将被画为虚的。
glLineStipple(2, 0x0F0F);

从三维的角度来看，一个多边形具有两个面。每一个面都可以设置不同的绘制方式：填充、只绘制边缘轮廓线、只绘制顶点，其中“填充”是默认的方式。可以为两个面分别设置不同的方式。
glPolygonMode(GL_FRONT, GL_FILL);            // 设置正面为填充方式
glPolygonMode(GL_BACK, GL_LINE);             // 设置反面为边缘绘制方式
glPolygonMode(GL_FRONT_AND_BACK, GL_POINT); // 设置两面均为顶点绘制方式

glFrontFace函数来交换“正面”和“反面”的概念。
glFrontFace(GL_CCW);   // 设置CCW方向为“正面”，CCW即CounterClockWise，逆时针
glFrontFace(GL_CW);    // 设置CW方向为“正面”，CW即ClockWise，顺时针

（3）剔除多边形表面
 
在三维空间中，一个多边形虽然有两个面，但我们无法看见背面的那些多边形，而一些多边形虽然是正面的，但被其他多边形所遮挡。如果将无法看见的多边形和可见的多边形同等对待，无疑会降低我们处理图形的效率。在这种时候，可以将不必要的面剔除。
 
首先，使用glEnable(GL_CULL_FACE);来启动剔除功能（使用glDisable(GL_CULL_FACE)可以关闭之）
 
然后，使用glCullFace来进行剔除。
 
glCullFace的参数可以是GL_FRONT，GL_BACK或者GL_FRONT_AND_BACK，分别表示剔除正面、剔除反面、剔除正反两面的多边形。
 
注意：剔除功能只影响多边形，而对点和直线无影响。例如，使用glCullFace(GL_FRONT_AND_BACK)后，所有的多边形都将被剔除，所以看见的就只有点和直线。

void myDisplay(void)
{
     glClear(GL_COLOR_BUFFER_BIT);
     glColor3f(0.0f, 1.0f, 1.0f);
     glRectf(-0.5f, -0.5f, 0.5f, 0.5f);
     glFlush();
}
注意：glColor系列函数，在参数类型不同时，表示“最大”颜色的值也不同。
采用f和d做后缀的函数，以1.0表示最大的使用。
采用b做后缀的函数，以127表示最大的使用。
采用ub做后缀的函数，以255表示最大的使用。
采用s做后缀的函数，以32767表示最大的使用。
采用us做后缀的函数，以65535表示最大的使用。


glut 总结：http://blog.chinaunix.net/uid-342902-id-2416141.html#
下面的glut函数供我们注册callback  function ，它们代表不同的事件，对callback function的格式也有要求：
glutReshapeFunc(void (*func)(int w,int h))
在windows窗口大小 "正在" 改变时执行callback function 
回调函数格式  
void  my_callback(int w,int h){
    //w,h 为windows窗口宽度 和 长度
}
glutKeyBoardFunc(void(*func)(unsigned char key,int x,int y))
glutMouseFunc(void(*func)(int button,int state,int x,int y))
glutMotionFunc(void(*func)(int x, int y))
glutIdleFunc(void(*func)(void))
注册一个函数，用来处理没有其他回调函数处理的事件
void glutTimerFunc(unsigned int msecs, void (*Func)(int value), int value)
注册一个回调函数,当指定时间值到达后,由GLUT调用注册的函数一次
msecs是等待的时间
Func是注册的函数
value是指定的一个数值,用来传递到回调函数Func中
这个函数注册了一个回调函数,当指定的毫秒数到达后,这个函数就调用注册的函数,value参数用来向这个注册的函数中传递参数.
下面的函数用于绘制图形
glutWireCube(GLdouble size);
glutSolidCube(GLdouble size);
glutWireTeapot(GLdouble size);




一些术语 ： 
orthographic  projection  正投影/平行投影
perspective projection    透视投影
Frustum   顶部被削平的金字塔
渲染 rendering :根据模型创建图像的过程
模型 model ：根据几何图元创建的
几何图元： vertex 点 直线 多边形 位图
像素 pixel
帧 frame
帧缓冲区 framebuffer
wireframe  model 线框模型，就是说场景中的物体都是用线型表示的
depth-cued  深度提示，就是远的线型看上去比较暗淡一些
antialiased  抗锯齿
flat-shading 单调着色 描述物体只用一种颜色，也没有光照效果
smooth-shading 平滑着色 更逼真
shadow 阴影  texture  纹理
texture  mapping  纹理贴图
motion-blurred 运动模糊
depth-of-field effect 景深效果







