#Is about level of permissions. If level is high enough you can allow user to authorized
Feature: I want to manage resource with lattice based access control

  Background:
    Given there are resource:
      | resource |
      | 1        |
      | 2        |
      | 3        |
      | 4        |
    And lattice users:
      | user     |
      | 1        |
      | 2        |
    And user lattice permissions:
      | resource | level |
      | 1        |     1 |
      | 2        |     5 |
    And resource lattice permissions
      | resource | expression    |
      | 1        |    level => 3 |
      | 2        |    level =  1 |
      | 3        |    level <= 4 |
      | 4        |    level =  2 |

  Scenario Outline: As user I want to modify resource
    Given "lbac" permissions
    And is resource with id <resource>
    When user with id <user> modify resource
    Then he should be allowed <result>

    Examples:
      | resource | user | result |
      |        1 |    1 |      0 |
      |        1 |    2 |      1 |
      |        2 |    1 |      1 |
      |        2 |    2 |      0 |
      |        3 |    1 |      1 |
      |        3 |    2 |      0 |
      |        4 |    1 |      0 |
      |        4 |    2 |      0 |

