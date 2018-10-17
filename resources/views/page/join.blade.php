<form method="post">
    <paginated-form class="application">
        <div label="Rules" icon="fa fa-clipboard-list" icon-color="red">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        Da Rules
                    </div>
                </div>
            </div>
        </div>

        <div label="Requirements" icon="fa fa-address-card" icon-color="orange">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 order-1 order-md-6 text-center-md">
                        <h1 class="display-5">Requirements</h1>
                        <p class="lead">We just need a few things from you...</p>
                    </div>
                    <div class="col-12 col-md-6 order-2">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>Email</label>
                                <icon-input type="email" icon="fa fa-envelope"></icon-input>
                            </div>
                            <div class="col-12">
                                <label>Minecraft Username</label>
                                <icon-input name="mc_username" icon="fa fa-address-card"></icon-input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div label="General Questions" icon="fa fa-question" icon-color="green">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>How long have you been playing Minecraft?</label>
                        <select name="minecraft_years" class="custom-select">
                            <option value="" disabled selected>Select Number of Years</option>
                            <option value="0">Less than a year</option>
                            <option value="1">1-2 years</option>
                            <option value="2">3-4 years</option>
                            <option value="3">5 or more years</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>How often do you usually play?</label>
                        <select name="minecraft_frequency" class="custom-select">
                            <option value="" disabled selected>Select Play Frequency</option>
                            <option value="0">As long as I'm awake</option>
                            <option value="1">Almost daily</option>
                            <option value="2">A few times aweek</option>
                            <option value="3">A few times a month</option>
                            <option value="4">I don't play Minecraft</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>How often do you usually play?</label>
                        <select name="minecraft_frequency" class="custom-select">
                            <option value="" disabled selected>Select Play Frequency</option>
                            <option value="0">As long as I'm awake</option>
                            <option value="1">Almost daily</option>
                            <option value="2">A few times aweek</option>
                            <option value="3">A few times a month</option>
                            <option value="4">I don't play Minecraft</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>What country are you from/do you reside?</label>
                        <select name="country" class="custom-select">
                            <option value="" disabled selected>Select Country</option>
                            @foreach (config("geography.countries") as $abbr => $name)
                                <option value="{{ $abbr }}">{{ $name }}</option>
                            @endforeach
                            <option value="OO">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>What timezone are you located in?</label>
                        <select name="timezone" class="custom-select">
                            <option value="" disabled selected>Select Country</option>
                            @foreach (config("geography.timezones") as $index => $timezone)
                                <option value="{{ $index }}">{{ $timezone["value"] }}</option>
                            @endforeach
                            <option value="OO">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Are you an English speaker?</label>
                        <select name="timezone" class="custom-select">
                            <option value="" disabled selected>Select Answer</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>What is your age group?</label>
                        <select name="timezone" class="custom-select">
                            <option value="" disabled selected>Select Age Group</option>
                            <option value="0">Under 15</option>
                            <option value="1">15-20</option>
                            <option value="2">21-25</option>
                            <option value="3">26-30</option>
                            <option value="4">31 or older</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div label="Resume" icon="fa fa-file-alt" icon-color="blue">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        Section D
                    </div>
                </div>
            </div>
        </div>
    </paginated-form>
</form>
