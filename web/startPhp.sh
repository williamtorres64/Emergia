#!/bin/bash

# Script to start PHP built-in server in a new tmux session

SESSION_NAME="php"
ADDRESS="192.168.0.100:8081"
DIRECTORY=$(pwd)

# Check if the tmux session already exists
tmux has-session -t $SESSION_NAME 2>/dev/null

if [ $? != 0 ]; then
    # Create a new tmux session and run the PHP server
    tmux new-session -d -s $SESSION_NAME "php -S $ADDRESS -t $DIRECTORY"
    echo "Started PHP server in tmux session '$SESSION_NAME' at $ADDRESS"
else
    echo "Tmux session '$SESSION_NAME' already exists."
fi

