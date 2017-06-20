判断root用户
================================================================================
```bash
#!/bin/bash
if [ $UID -ne 0 ]; then
	echo "not root user";
else 
	echo "Root User";
fi
```



