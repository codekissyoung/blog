# bash 控制台颜色
打印全部颜色
```
#!/bin/bash
for STYLE in 0 1 2 3 4 5 6 7; do
  for FG in 30 31 32 33 34 35 36 37; do
    for BG in 40 41 42 43 44 45 46 47; do
      CTRL="\033[${STYLE};${FG};${BG}m";
      echo -en "${CTRL}";
      echo -n "${STYLE};${FG};${BG}";
    done
  done
done
echo -e "\e[1;34mThis is a blue text.\e[0m"
```
参考 [Bash: Using Colors](http://webhome.csc.uvic.ca/~sae/seng265/fall04/tips/s265s047-tips/bash-using-colors.html)
