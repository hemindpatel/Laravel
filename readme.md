## Laravel Base Structure with 5.8 version

- [Laravel Doc](https://laravel.com/docs/5.8)

#### Steps for 3 local commit combining in 1 commit message before pushing on branch
- 3 local commits in local branch (without pushing code on branch)
- then run "git rebase -i HEAD~3"
- open editor with 3 most recent commit message
- replaced "pick" with "squash" in front of each commit below the first one line(before edit press "insert" button)
- then press "ESC" key then press SHIFT + ":" and write "wq" and press "ENTER" key
- Again open up one more editor and if you want to edit commit message then replace first commit message and save using most recent above instruction.
- push on the branch

### update most recent commit message
- Run `git commit --amend -m "your message"`
