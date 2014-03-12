Feature: debug
    
    Scenario: Download existing file
        When I run download function on quixplorer with selitems[]=huhu.txt
        Then I reject an error (You are not allowed to access this item)
        Then I expect success and result containing (huhuhaha)


