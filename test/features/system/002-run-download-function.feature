Feature: Download multiple files
    In order to download several files from quixplorer,
    i select the files and execute the 'download  multiple files' function

    Scenario: Download without files
        When I run download function on quixplorer without args
        Then I expect an error "You haven't selected any item"

    Scenario: Download non-existing file
        When I run download_selected function on quixplorer with selitems[]=huhu.jpg
        Then I expect an error "You are not allowed to access this item"

    Scenario: Download existing file
        When I run download_selected function on quixplorer with selitems[]=huhu.txt
        Then I reject an error "You are not allowed to access this item"
        Then I expect success and result containing "huhuhaha"

    Scenario: Download 2 existing files, one not existing
        When I run download_selected function on quixplorer with selitems[]=huhu.txt&selitems[]=non_existent.txt
        Then I expect an error "You are not allowed to access this item"

    Scenario: Download 2 existing files, both existing
        When I run download_selected function on quixplorer with selitems[]=huhu.txt&selitems[]=haha.txt
        Then I reject an error "You are not allowed to access this item"
        Then I expect success and a binary result
        Then I write the binary result to "test.zip"
        Then I find "huhu.txt" in zip content of "test.zip" 
        Then I find "haha.txt" in zip content of "test.zip" 

    Scenario: Download existing inacessable file outside data directory
        When I run download_selected function on quixplorer with selitems[]=huhu.txt&selitems[]=../inaccessable.txt
        Then I expect an error "You are not allowed to access this item"
