Feature: Inpost api
  Scenario: Fetch data from inpost api for points scope and Kozy city
    When I use service FetchDataFromImport with scope "points" and city "Kozy"
    Then The results should contains sample result data