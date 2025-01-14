<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard1/style.css')); ?>">
    <title>Dashboard Design #02 | AsmrProg</title>
</head>

<body>

    <div class="top-container">

        <div class="nav">
            <div class="logo">
                <i class='bx bxl-codepen'></i>
                <a href="#">AsmrProg</a>
            </div>

            <div class="nav-links">
                <a href="#">Dashboard</a>
                <a href="#">Statistics</a>
                <a href="#">Courses</a>
                <a href="#">Settings</a>
            </div>

            <div class="right-section">
                <i class='bx bx-bell'></i>
                <i class='bx bx-search'></i>

                <div class="profile">
                    <div class="info">
                        <img src="assets/profile.png">
                        <div>
                            <a href="#">Alex Johnson</a>
                            <p>Data Scientist</p>
                        </div>
                    </div>
                    <i class='bx bx-chevron-down'></i>
                </div>
            </div>

        </div>

        <div class="status">
            <div class="header">
                <h4 id="big">Your courses</h4>
                <h4 id="small">Weekly Activity</h4>
            </div>

            <div class="items-list">
                <div class="item">
                    <div class="info">
                        <div>
                            <h5>Data Analysis</h5>
                            <p>- 3 lessons left</p>
                            <p>- 1 project left</p>
                        </div>
                        <i class='bx bx-data'></i>
                    </div>
                    <div class="progress">
                        <div class="bar"></div>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div>
                            <h5>Machine Learn</h5>
                            <p>- 2 assignments left</p>
                            <p>- 5 tutorials left</p>
                        </div>
                        <i class='bx bx-terminal'></i>
                    </div>
                    <div class="progress">
                        <div class="bar"></div>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div>
                            <h5>Python</h5>
                            <p>- 4 chapters left</p>
                            <p>- 8 quizzes left</p>
                        </div>
                        <i class='bx bxl-python'></i>
                    </div>
                    <div class="progress">
                        <div class="bar"></div>
                    </div>
                </div>
                <div class="item">
                    <canvas class="activity-chart"></canvas>
                </div>
            </div>

        </div>



    </div>


    <div class="bottom-container">

        <div class="prog-status">
            <div class="header">
                <h4>learning Progress</h4>
                <div class="tabs">
                    <a href="#" class="active">1Y</a>
                    <a href="#">6M</a>
                    <a href="#">3M</a>
                </div>
            </div>

            <div class="details">
                <div class="item">
                    <h2>3.45</h2>
                    <p>Current GPA</p>
                </div>
                <div class="separator"></div>
                <div class="item">
                    <h2>4.78</h2>
                    <p>Class Average GPA</p>
                </div>
            </div>

            <canvas class="prog-chart"></canvas>

        </div>

        <div class="popular">
            <div class="header">
                <h4>Popular</h4>
                <a href="#"># Data</a>
            </div>

            <img src="assets/podcast.jpg">
            <div class="audio">
                <i class='bx bx-podcast'></i>
                <a href="#">Poedcast: Mastering Data Visualization</a>
            </div>
            <p>Learn to create compelling visualizations with data.</p>
            <div class="listen">
                <div class="author">
                    <img src="assets/profile.png">
                    <div>
                        <a href="#">Alex</a>
                        <p>Data Analyst</p>
                    </div>
                </div>
                <button>Listen<i class='bx bx-right-arrow-alt'></i></button>
            </div>

        </div>


        <div class="upcoming">

            <div class="header">
                <h4>You may like it</h4>
                <a href="#">July <i class='bx bx-chevron-down'></i></a>
            </div>

            <div class="dates">
                <div class="item">
                    <h5>Mo</h5>
                    <a href="#">12</a>
                </div>
                <div class="item active">
                    <h5>Tu</h5>
                    <a href="#">13</a>
                </div>
                <div class="item">
                    <h5>We</h5>
                    <a href="#">14</a>
                </div>
                <div class="item">
                    <h5>Th</h5>
                    <a href="#">15</a>
                </div>
                <div class="item">
                    <h5>Fr</h5>
                    <a href="#">16</a>
                </div>
                <div class="item">
                    <h5>Sa</h5>
                    <a href="#">17</a>
                </div>
                <div class="item">
                    <h5>Su</h5>
                    <a href="#">18</a>
                </div>
            </div>

            <div class="events">
                <div class="item">
                    <div>
                        <i class='bx bx-time'></i>
                        <div class="event-info">
                            <a href="#">Data Science</a>
                            <p>10:00-11:30</p>
                        </div>
                    </div>
                    <i class='bx bx-dots-horizontal-rounded'></i>
                </div>
                <div class="item">
                    <div>
                        <i class='bx bx-time'></i>
                        <div class="event-info">
                            <a href="#">Machine Learning</a>
                            <p>13:30-15:00</p>
                        </div>
                    </div>
                    <i class='bx bx-dots-horizontal-rounded'></i>
                </div>
                <div class="item">
                    <div>
                        <i class='bx bx-time'></i>
                        <div class="event-info">
                            <a href="#">Beginner Python</a>
                            <p>11:30-13:00</p>
                        </div>
                    </div>
                    <i class='bx bx-dots-horizontal-rounded'></i>
                </div>
                <div class="item">
                    <div>
                        <i class='bx bx-time'></i>
                        <div class="event-info">
                            <a href="#">Introduction to SQL</a>
                            <p>10:00-11:30</p>
                        </div>
                    </div>
                    <i class='bx bx-dots-horizontal-rounded'></i>
                </div>
            </div>

        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo e(asset('dashboard1/script.js')); ?>"></script>

</body>

</html><?php /**PATH C:\laragon\www\perpustakaan-master\resources\views/dashboard1.blade.php ENDPATH**/ ?>