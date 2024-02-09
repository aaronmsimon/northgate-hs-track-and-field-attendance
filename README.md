# Northgate High School Track and Field Attendance Tracker

![GitHub License](https://img.shields.io/github/license/aaronmsimon/northgate-hs-track-and-field-attendance)
![GitHub commit activity](https://img.shields.io/github/commit-activity/w/aaronmsimon/northgate-hs-track-and-field-attendance)
![GitHub last commit](https://img.shields.io/github/last-commit/aaronmsimon/northgate-hs-track-and-field-attendance)
![GitHub language count](https://img.shields.io/github/languages/count/aaronmsimon/northgate-hs-track-and-field-attendance)

![Northgate Broncos](https://github.com/aaronmsimon/northgate-hs-track-and-field-attendance/blob/main/project-root/public/img/BroncosOfficialLogo2016yellowgold.png?raw=true)

<a href="http://www.northgatetrackandfieldcheck.in/index.php/check-in"><img src="https://raw.githubusercontent.com/aaronmsimon/northgate-hs-track-and-field-attendance/main/project-root/public/img/qr-code-attendance.png" /></a>

## Version History
| Version | Release Date | Description |
| --- | --- | --- |
| 0.1 | 2024-02-09 | MVP |

## Backlog

### Error Handling
1. Format the validation error so it appears in a more user-friendly way
2. Enable new student (no record in DB) tracking

### Coaches' Features
1. View student attendance
2. View student roster with filters for gender and grade
3. Export attendance to CSV

### Fun Features
1. Add birthday message
2. Add badges (gamification)
3. Add leaderboards

### Technical Improvements
1. Add year to roster to avoid having to clear database each season
2. Fix Mod Rewrite to remove index.php in URL
3. Disable check-in based on time of day
4. Track during meets?
5. Add geocoding to check-in?